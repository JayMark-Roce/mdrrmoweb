{{-- 
    NOTIFICATION BELL SNIPPET
    Copy this entire file content to any admin page that needs notification bell functionality.
    Paste the CSS in the <style> section, HTML before </body>, and JavaScript in <script> section.
--}}

{{-- ===== CSS (Add to <style> section) ===== --}}
{{-- 
/* Notification Bell & Panel */
.notif-bell-container { position: fixed; bottom: 60px; right: 30px; z-index: 9999; }
.notif-bell { background: #0b2a55; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; cursor: pointer; box-shadow: 0 4px 15px rgba(0,0,0,0.3); transition: transform 0.2s; position: relative; }
.notif-bell:hover { transform: scale(1.1); }
.notif-badge { position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; font-size: 12px; font-weight: bold; padding: 4px 8px; border-radius: 50%; border: 2px solid white; display: none; }
.notif-panel { position: absolute; bottom: 80px; right: 0; width: 350px; background: white; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); display: none; flex-direction: column; overflow: hidden; border: 1px solid #e5e7eb; }
.notif-panel.active { display: flex; }
.notif-header { padding: 15px; background: #f8fafc; border-bottom: 1px solid #e5e7eb; font-weight: 700; display: flex; justify-content: space-between; }
.notif-list { max-height: 400px; overflow-y: auto; }
.notif-item { padding: 15px; border-bottom: 1px solid #f1f5f9; cursor: pointer; display: flex; gap: 12px; }
.notif-item:hover { background: #f1f5f9; }
.notif-item.new { background: #eff6ff; }
.notif-item .icon-box { width: 36px; height: 36px; background: #fee2e2; color: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }

/* Global Toast */
#global-toast-container { position: fixed; top: 20px; right: 20px; z-index: 10000; display: flex; flex-direction: column; gap: 10px; pointer-events: none; }
.global-toast { background: white; border-left: 5px solid #ef4444; padding: 15px 20px; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 15px; min-width: 300px; pointer-events: auto; animation: slideIn 0.4s ease-out; cursor: pointer; }
@keyframes slideIn { from { transform: translateX(100%); } to { transform: translateX(0); } }
--}}

{{-- ===== HTML (Add before </body> tag) ===== --}}
{{-- 
<!-- Notification Bell Container -->
<div class="notif-bell-container">
    <div class="notif-panel" id="notifPanel">
        <div class="notif-header">
            <span>Notifications</span>
            <a href="#" onclick="clearBadge()" style="font-size:12px; color:#3b82f6;">Mark read</a>
        </div>
        <div class="notif-list" id="notifList">
            <div style="padding:20px; text-align:center; color:#94a3b8;">No notifications</div>
        </div>
    </div>
    <div class="notif-bell" onclick="toggleNotif()">
        <i class="fas fa-bell"></i>
        <span class="notif-badge" id="notifBadge">0</span>
    </div>
</div>

<!-- Global Toast Container -->
<div id="global-toast-container"></div>

<!-- Audio Element for Notifications -->
<audio id="globalSound" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3" preload="auto"></audio>
--}}

{{-- ===== JAVASCRIPT (Add to <script> section, ensure Supabase is loaded first) ===== --}}
{{-- 
    // ===== NOTIFICATION BELL FUNCTIONALITY =====
    // SINGLE Supabase client (avoid multiple instances)
    let supabaseClient = window.supabaseClient || null;
    if (!supabaseClient && typeof supabase !== 'undefined') {
        const SUPABASE_URL = "https://bhcecrbyknorjzkjazxu.supabase.co";
        const SUPABASE_KEY = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJoY2VjcmJ5a25vcmp6a2phenh1Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTkyMDYwNDMsImV4cCI6MjA3NDc4MjA0M30.Nfv0vHVk1IyN1gz1Y4mdogL9ChsV0DkiMQivuYnolt4";
        supabaseClient = supabase.createClient(SUPABASE_URL, SUPABASE_KEY);
        window.supabaseClient = supabaseClient;
    }

    let unread = 0;

    // Real-time listener for notifications
    if (supabaseClient) {
        const reportsChannel = supabaseClient
            .channel('public:reports')
            .on(
                'postgres_changes',
                { event: 'INSERT', schema: 'public', table: 'reports' },
                (payload) => {
                    const data = payload.new;

                    // Play sound
                    const audio = document.getElementById('globalSound');
                    if (audio) {
                        audio.loop = true;
                        audio.playbackRate = 1.5;
                        audio.play().catch(() => console.log('Autoplay prevented'));
                    }

                    // Show toast
                    const toast = document.createElement('div');
                    toast.className = 'global-toast';
                    toast.innerHTML = `
                        <div style="font-size:20px; color:#ef4444;"><i class="fas fa-exclamation-circle"></i></div>
                        <div>
                            <div style="font-weight:800; color:#1e293b;">New Incident!</div>
                            <div style="font-size:13px; color:#64748b;">${data.incident_type} at ${data.location || 'Unknown'}</div>
                        </div>
                    `;
                    toast.onclick = () => window.location.href = "{{ route('reported-cases') }}";
                    const toastContainer = document.getElementById('global-toast-container');
                    if (toastContainer) {
                        toastContainer.appendChild(toast);
                        setTimeout(() => toast.remove(), 10000);
                    }

                    // Update bell badge
                    unread++;
                    const badge = document.getElementById('notifBadge');
                    if (badge) {
                        badge.innerText = unread;
                        badge.style.display = 'block';
                    }

                    // Add to notification list
                    const item = document.createElement('div');
                    item.className = 'notif-item new';
                    item.innerHTML = `
                        <div class="icon-box"><i class="fas fa-fire"></i></div>
                        <div>
                            <div style="font-weight:700; font-size:14px;">${data.incident_type}</div>
                            <div style="font-size:12px; color:#64748b;">${data.location}</div>
                        </div>
                    `;
                    item.onclick = () => window.location.href = "{{ route('reported-cases') }}";
                    const list = document.getElementById('notifList');
                    if (list) {
                        if (list.children[0]?.innerText.includes('No notifications')) {
                            list.innerHTML = '';
                        }
                        list.prepend(item);
                    }

                    // Dispatch custom event for other scripts if needed
                    window.dispatchEvent(new CustomEvent('new-incident-reported', { detail: data }));
                }
            )
            .subscribe();
    }

    function toggleNotif() {
        const panel = document.getElementById('notifPanel');
        if (panel) {
            panel.classList.toggle('active');
        }
    }

    function clearBadge() {
        unread = 0;
        const badge = document.getElementById('notifBadge');
        if (badge) {
            badge.style.display = 'none';
        }
        const audio = document.getElementById('globalSound');
        if (audio) {
            audio.pause();
            audio.currentTime = 0;
            audio.loop = false;
        }
    }
    // ===== END NOTIFICATION BELL FUNCTIONALITY =====
--}}









