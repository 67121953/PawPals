@auth
<style>
    .pp-chat-button {
        position: fixed;
        right: 24px;
        bottom: 24px;
        width: 58px;
        height: 58px;
        border: 0;
        border-radius: 50%;
        background: #7c3aed;
        color: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,.20);
        z-index: 9999;
        cursor: pointer;
        font-size: 22px;
    }

    .pp-chat-badge {
        position: absolute;
        top: -4px;
        right: -2px;
        min-width: 22px;
        height: 22px;
        padding: 0 6px;
        border-radius: 999px;
        background: #ef4444;
        color: #fff;
        font-size: 12px;
        display: none;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        border: 2px solid #fff;
    }

    .pp-chat-window {
        position: fixed;
        right: 24px;
        bottom: 94px;
        width: 360px;
        max-width: calc(100vw - 32px);
        height: 520px;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 20px 60px rgba(0,0,0,.20);
        overflow: hidden;
        z-index: 9998;
        display: none;
        flex-direction: column;
        border: 1px solid #eee;
    }

    .pp-chat-window.open { display: flex; }

    .pp-chat-header {
        background: #7c3aed;
        color: #fff;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .pp-chat-header strong { display: block; }
    .pp-chat-header small { opacity: .85; }

    .pp-chat-close {
        border: 0;
        background: transparent;
        color: #fff;
        font-size: 22px;
        cursor: pointer;
    }

    .pp-chat-body {
        flex: 1;
        overflow-y: auto;
        padding: 14px;
        background: #f8fafc;
    }

    .pp-msg {
        max-width: 82%;
        margin-bottom: 10px;
        padding: 9px 12px;
        border-radius: 14px;
        line-height: 1.45;
        font-size: 14px;
        white-space: pre-wrap;
        word-break: break-word;
    }

    .pp-msg.me {
        margin-left: auto;
        background: #7c3aed;
        color: #fff;
        border-bottom-right-radius: 4px;
    }

    .pp-msg.other {
        margin-right: auto;
        background: #fff;
        color: #1f2937;
        border: 1px solid #e5e7eb;
        border-bottom-left-radius: 4px;
    }

    .pp-msg-meta {
        display: block;
        margin-top: 4px;
        font-size: 10px;
        opacity: .65;
    }

    .pp-chat-form {
        display: flex;
        gap: 8px;
        padding: 10px;
        border-top: 1px solid #eee;
        background: #fff;
    }

    .pp-chat-input {
        flex: 1;
        border: 1px solid #ddd;
        border-radius: 22px;
        padding: 10px 14px;
        outline: none;
        resize: none;
        height: 42px;
    }

    .pp-chat-send {
        width: 42px;
        height: 42px;
        border: 0;
        border-radius: 50%;
        background: #7c3aed;
        color: #fff;
        cursor: pointer;
    }

    .pp-chat-admin-list {
        display: none;
        width: 145px;
        flex-shrink: 0;
        border-right: 1px solid #eee;
        overflow-y: auto;
        background: #fff;
    }

    .pp-chat-admin-list.active { display: block; }
    .pp-chat-admin-item {
        width: 100%;
        text-align: left;
        border: 0;
        background: #fff;
        padding: 11px;
        border-bottom: 1px solid #f1f1f1;
        cursor: pointer;
    }
    .pp-chat-admin-item:hover,
    .pp-chat-admin-item.selected { background: #f5f3ff; }
    .pp-chat-admin-item strong { display: block; font-size: 13px; }
    .pp-chat-admin-item small { display: block; font-size: 10px; color: #6b7280; }
    .pp-chat-admin-unread {
        float: right;
        background: #ef4444;
        color: #fff;
        border-radius: 999px;
        padding: 1px 5px;
        font-size: 10px;
    }

    .pp-chat-content {
        display: flex;
        flex: 1;
        min-height: 0;
    }

    .pp-chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .pp-chat-empty {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #9ca3af;
        padding: 20px;
    }

    @media (max-width: 480px) {
        .pp-chat-button { right: 14px; bottom: 14px; }
        .pp-chat-window { right: 8px; bottom: 82px; width: calc(100vw - 16px); height: 70vh; }
        .pp-chat-admin-list { width: 125px; }
    }
</style>

<button id="ppChatButton" class="pp-chat-button" type="button" aria-label="เปิดแชต">
    <i class="fa-solid fa-comment-dots"></i>
    <span id="ppChatBadge" class="pp-chat-badge"></span>
</button>

<div id="ppChatWindow" class="pp-chat-window" aria-hidden="true">
    <div class="pp-chat-header">
        <div>
            <strong id="ppChatTitle">
                {{ auth()->user()->role === 'admin' ? 'ข้อความจากผู้ติดต่อ' : 'PawPals Chat' }}
            </strong>
            <small id="ppChatSubtitle">
                {{ auth()->user()->role === 'admin' ? 'เลือกผู้ติดต่อเพื่อสนทนา' : 'คุยกับทีม PawPals' }}
            </small>
        </div>
        <button id="ppChatClose" class="pp-chat-close" type="button">&times;</button>
    </div>

    <div class="pp-chat-content">
        @if(auth()->user()->role === 'admin')
            <div id="ppChatAdminList" class="pp-chat-admin-list"></div>
        @endif

        <div class="pp-chat-main">
            <div id="ppChatBody" class="pp-chat-body">
                <div class="pp-chat-empty">กำลังโหลดข้อความ...</div>
            </div>

            <form id="ppChatForm" class="pp-chat-form">
                @csrf
                <textarea id="ppChatInput"
                          class="pp-chat-input"
                          maxlength="5000"
                          placeholder="พิมพ์ข้อความ..."
                          required></textarea>
                <button class="pp-chat-send" type="submit" aria-label="ส่ง">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
(function () {
    const button = document.getElementById('ppChatButton');
    const windowEl = document.getElementById('ppChatWindow');
    const close = document.getElementById('ppChatClose');
    const body = document.getElementById('ppChatBody');
    const form = document.getElementById('ppChatForm');
    const input = document.getElementById('ppChatInput');
    const badge = document.getElementById('ppChatBadge');
    const adminList = document.getElementById('ppChatAdminList');
    const isAdmin = @json(auth()->user()->role === 'admin');
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    let selectedConversation = null;
    let open = false;

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.textContent = value ?? '';
        return div.innerHTML;
    }

    function timeText(dateString) {
        if (!dateString) return '';
        return new Date(dateString).toLocaleString('th-TH', {
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function renderMessages(messages) {
        if (!messages || messages.length === 0) {
            body.innerHTML = '<div class="pp-chat-empty">ยังไม่มีข้อความ<br>เริ่มพูดคุยได้เลยครับ 😊</div>';
            return;
        }

        body.innerHTML = messages.map(m => {
            const me = Number(m.sender_id) === {{ auth()->id() }};
            return `<div class="pp-msg ${me ? 'me' : 'other'}">
                        ${escapeHtml(m.message)}
                        <span class="pp-msg-meta">${escapeHtml(m.sender?.name || '')} · ${timeText(m.created_at)}</span>
                    </div>`;
        }).join('');

        body.scrollTop = body.scrollHeight;
    }

    async function loadUserChat() {
        const res = await fetch('{{ route('chat.index') }}', {
            headers: { 'Accept': 'application/json' }
        });
        if (!res.ok) return;
        const data = await res.json();
        renderMessages(data.messages || []);
    }

    function renderAdminList(conversations) {
        if (!adminList) return;

        adminList.innerHTML = conversations.map(c => {
            const selected = Number(c.id) === Number(selectedConversation);
            const unread = Number(c.unread_count || 0);
            return `<button type="button"
                            class="pp-chat-admin-item ${selected ? 'selected' : ''}"
                            data-conversation="${c.id}">
                        ${unread ? `<span class="pp-chat-admin-unread">${unread}</span>` : ''}
                        <strong>${escapeHtml(c.user?.name || 'ไม่ทราบชื่อ')}</strong>
                        <small>${escapeHtml(c.user?.email || '')}</small>
                    </button>`;
        }).join('');

        adminList.querySelectorAll('[data-conversation]').forEach(btn => {
            btn.addEventListener('click', () => {
                selectedConversation = btn.dataset.conversation;
                loadAdminConversation(selectedConversation);
            });
        });
    }

    async function loadAdminConversation(id) {
        const res = await fetch('/chat/conversations/' + id, {
            headers: { 'Accept': 'application/json' }
        });
        if (!res.ok) return;
        const data = await res.json();
        selectedConversation = data.conversation.id;
        document.getElementById('ppChatTitle').textContent = data.conversation.user?.name || 'ผู้ติดต่อ';
        document.getElementById('ppChatSubtitle').textContent = data.conversation.user?.email || '';
        renderMessages(data.messages || []);
        updateUnread();
    }

    async function loadAdminList() {
        const res = await fetch('{{ route('chat.index') }}', {
            headers: { 'Accept': 'application/json' }
        });
        if (!res.ok) return;
        const data = await res.json();
        renderAdminList(data.conversations || []);

        if (!selectedConversation && data.conversations?.length) {
            selectedConversation = data.conversations[0].id;
            loadAdminConversation(selectedConversation);
        }
    }

    async function updateUnread() {
        const res = await fetch('{{ route('chat.unread') }}', {
            headers: { 'Accept': 'application/json' }
        });
        if (!res.ok) return;
        const data = await res.json();
        const count = Number(data.count || 0);

        badge.textContent = count > 99 ? '99+' : count;
        badge.style.display = count > 0 ? 'flex' : 'none';
    }

    button.addEventListener('click', async () => {
        open = !open;
        windowEl.classList.toggle('open', open);
        windowEl.setAttribute('aria-hidden', String(!open));

        if (!open) return;

        if (isAdmin) {
            await loadAdminList();
        } else {
            await loadUserChat();
        }

        await updateUnread();
        input.focus();
    });

    close.addEventListener('click', () => {
        open = false;
        windowEl.classList.remove('open');
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const message = input.value.trim();
        if (!message) return;

        if (isAdmin && !selectedConversation) {
            alert('กรุณาเลือกผู้ติดต่อก่อนส่งข้อความ');
            return;
        }

        const payload = {
            message: message,
            conversation_id: isAdmin ? selectedConversation : null
        };

        const res = await fetch('{{ route('chat.send') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify(payload)
        });

        if (!res.ok) {
            alert('ไม่สามารถส่งข้อความได้ กรุณาลองใหม่');
            return;
        }

        input.value = '';

        if (isAdmin) {
            await loadAdminConversation(selectedConversation);
        } else {
            await loadUserChat();
        }

        await updateUnread();
    });

    // อัปเดตข้อความอัตโนมัติทุก 5 วินาที ขณะเปิดหน้าต่าง
    setInterval(async () => {
        if (!open) {
            await updateUnread();
            return;
        }

        if (isAdmin) {
            await loadAdminList();
            if (selectedConversation) await loadAdminConversation(selectedConversation);
        } else {
            await loadUserChat();
        }

        await updateUnread();
    }, 5000);

    updateUnread();
})();
</script>
@endauth
