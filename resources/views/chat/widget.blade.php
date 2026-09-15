@auth

<style>

    /*
    |--------------------------------------------------------------------------
    | Chat Button
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | Badge
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | Chat Window
    |--------------------------------------------------------------------------
    */

    .pp-chat-window {

        position: fixed;

        right: 24px;
        bottom: 94px;

        width: 620px;
        max-width: calc(100vw - 32px);

        height: 560px;

        background: #fff;

        border-radius: 18px;

        box-shadow: 0 20px 60px rgba(0,0,0,.20);

        overflow: hidden;

        z-index: 9998;

        display: none;

        flex-direction: column;

        border: 1px solid #eee;
    }


    .pp-chat-window.open {
        display: flex;
    }


    /*
    |--------------------------------------------------------------------------
    | Header
    |--------------------------------------------------------------------------
    */

    .pp-chat-header {

        background: #7c3aed;

        color: #fff;

        padding: 14px 16px;

        display: flex;

        align-items: center;

        justify-content: space-between;
    }


    .pp-chat-header strong {
        display: block;
    }


    .pp-chat-header small {
        opacity: .85;
    }


    .pp-chat-close {

        border: 0;

        background: transparent;

        color: #fff;

        font-size: 22px;

        cursor: pointer;
    }


    /*
    |--------------------------------------------------------------------------
    | Main Content
    |--------------------------------------------------------------------------
    */

    .pp-chat-content {

        display: flex;

        flex: 1;

        min-height: 0;
    }


    /*
    |--------------------------------------------------------------------------
    | Admin User List
    |--------------------------------------------------------------------------
    */

    .pp-chat-admin-panel {

        width: 220px;

        flex-shrink: 0;

        border-right: 1px solid #eee;

        background: #fff;

        display: flex;

        flex-direction: column;

        min-height: 0;
    }


    .pp-chat-search {

        padding: 10px;

        border-bottom: 1px solid #eee;
    }


    .pp-chat-search input {

        width: 100%;

        border: 1px solid #ddd;

        border-radius: 10px;

        padding: 8px 10px;

        outline: none;

        font-size: 13px;
    }


    .pp-chat-admin-list {

        flex: 1;

        overflow-y: auto;
    }


    .pp-chat-admin-item {

        width: 100%;

        text-align: left;

        border: 0;

        background: #fff;

        padding: 12px;

        border-bottom: 1px solid #f1f1f1;

        cursor: pointer;

        transition: .15s;
    }


    .pp-chat-admin-item:hover {

        background: #f5f3ff;
    }


    .pp-chat-admin-item.selected {

        background: #ede9fe;
    }


    .pp-chat-admin-item strong {

        display: block;

        font-size: 13px;

        color: #1f2937;

        padding-right: 25px;
    }


    .pp-chat-admin-item small {

        display: block;

        font-size: 10px;

        color: #6b7280;

        margin-top: 3px;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .pp-chat-admin-unread {

        float: right;

        background: #ef4444;

        color: #fff;

        border-radius: 999px;

        padding: 2px 6px;

        font-size: 10px;
    }


    .pp-chat-no-user {

        padding: 25px 15px;

        text-align: center;

        color: #9ca3af;

        font-size: 13px;
    }


    /*
    |--------------------------------------------------------------------------
    | Chat Main
    |--------------------------------------------------------------------------
    */

    .pp-chat-main {

        flex: 1;

        display: flex;

        flex-direction: column;

        min-width: 0;
    }


    /*
    |--------------------------------------------------------------------------
    | Message Body
    |--------------------------------------------------------------------------
    */

    .pp-chat-body {

        flex: 1;

        overflow-y: auto;

        padding: 14px;

        background: #f8fafc;
    }


    /*
    |--------------------------------------------------------------------------
    | Message
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | Empty
    |--------------------------------------------------------------------------
    */

    .pp-chat-empty {

        height: 100%;

        display: flex;

        align-items: center;

        justify-content: center;

        text-align: center;

        color: #9ca3af;

        padding: 20px;
    }


    /*
    |--------------------------------------------------------------------------
    | Form
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | Mobile
    |--------------------------------------------------------------------------
    */

    @media (max-width: 700px) {

        .pp-chat-window {

            right: 8px;

            bottom: 82px;

            width: calc(100vw - 16px);

            height: 70vh;
        }


        .pp-chat-admin-panel {

            width: 145px;
        }

    }


    @media (max-width: 480px) {

        .pp-chat-button {

            right: 14px;

            bottom: 14px;
        }


        .pp-chat-admin-panel {

            width: 120px;
        }

    }

</style>


<!-- ========================================================= -->
<!-- CHAT BUTTON -->
<!-- ========================================================= -->

<button
    id="ppChatButton"
    class="pp-chat-button"
    type="button"
    aria-label="เปิดแชต"
>

    <i class="fa-solid fa-comment-dots"></i>

    <span
        id="ppChatBadge"
        class="pp-chat-badge"
    ></span>

</button>


<!-- ========================================================= -->
<!-- CHAT WINDOW -->
<!-- ========================================================= -->

<div
    id="ppChatWindow"
    class="pp-chat-window"
    aria-hidden="true"
>

    <!-- HEADER -->

    <div class="pp-chat-header">

        <div>

            <strong id="ppChatTitle">

                {{ auth()->user()->role === 'admin'
                    ? 'ข้อความจากผู้ติดต่อ'
                    : 'PawPals Chat'
                }}

            </strong>

            <small id="ppChatSubtitle">

                {{ auth()->user()->role === 'admin'
                    ? 'เลือกผู้ติดต่อเพื่อสนทนา'
                    : 'คุยกับทีม PawPals'
                }}

            </small>

        </div>


        <button
            id="ppChatClose"
            class="pp-chat-close"
            type="button"
        >
            &times;
        </button>

    </div>


    <!-- CONTENT -->

    <div class="pp-chat-content">


        <!-- ================================================= -->
        <!-- ADMIN -->
        <!-- ================================================= -->

        @if(auth()->user()->role === 'admin')

            <div class="pp-chat-admin-panel">

                <!-- Search -->

                <div class="pp-chat-search">

                    <input
                        type="text"
                        id="ppChatSearch"
                        placeholder="ค้นหาชื่อ / Email..."
                    >

                </div>


                <!-- User List -->

                <div
                    id="ppChatAdminList"
                    class="pp-chat-admin-list"
                ></div>

            </div>

        @endif


        <!-- ================================================= -->
        <!-- CHAT MAIN -->
        <!-- ================================================= -->

        <div class="pp-chat-main">


            <!-- Messages -->

            <div
                id="ppChatBody"
                class="pp-chat-body"
            >

                <div class="pp-chat-empty">

                    กำลังโหลดข้อความ...

                </div>

            </div>


            <!-- Form -->

            <form
                id="ppChatForm"
                class="pp-chat-form"
            >

                @csrf

                <textarea
                    id="ppChatInput"
                    class="pp-chat-input"
                    maxlength="5000"
                    placeholder="พิมพ์ข้อความ..."
                    required
                ></textarea>


                <button
                    class="pp-chat-send"
                    type="submit"
                    aria-label="ส่ง"
                >

                    <i class="fa-solid fa-paper-plane"></i>

                </button>

            </form>

        </div>

    </div>

</div>


<script>

(function () {

    /*
    |--------------------------------------------------------------------------
    | Elements
    |--------------------------------------------------------------------------
    */

    const button =
        document.getElementById('ppChatButton');

    const windowEl =
        document.getElementById('ppChatWindow');

    const close =
        document.getElementById('ppChatClose');

    const body =
        document.getElementById('ppChatBody');

    const form =
        document.getElementById('ppChatForm');

    const input =
        document.getElementById('ppChatInput');

    const badge =
        document.getElementById('ppChatBadge');

    const adminList =
        document.getElementById('ppChatAdminList');

    const searchInput =
        document.getElementById('ppChatSearch');


    /*
    |--------------------------------------------------------------------------
    | User Data
    |--------------------------------------------------------------------------
    */

    const currentUserId =
        Number(@json(auth()->id()));


    const isAdmin =
        @json(auth()->user()->role === 'admin');


    const csrf =
        document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute('content');


    /*
    |--------------------------------------------------------------------------
    | State
    |--------------------------------------------------------------------------
    */

    let selectedConversation = null;

    let conversations = [];

    let open = false;


    /*
    |--------------------------------------------------------------------------
    | Escape HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {

        const div =
            document.createElement('div');

        div.textContent =
            value ?? '';

        return div.innerHTML;
    }


    /*
    |--------------------------------------------------------------------------
    | Time
    |--------------------------------------------------------------------------
    */

    function timeText(dateString) {

        if (!dateString) {
            return '';
        }

        return new Date(dateString)
            .toLocaleString(
                'th-TH',
                {
                    hour: '2-digit',
                    minute: '2-digit'
                }
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Render Messages
    |--------------------------------------------------------------------------
    */

    function renderMessages(messages) {

        if (
            !messages ||
            messages.length === 0
        ) {

            body.innerHTML = `

                <div class="pp-chat-empty">

                    ยังไม่มีข้อความ<br>

                    เริ่มพูดคุยได้เลยครับ 😊

                </div>

            `;

            return;
        }


        body.innerHTML =
            messages
                .map(function (m) {

                    const me =
                        Number(m.sender_id)
                        === currentUserId;


                    return `

                        <div class="pp-msg ${me ? 'me' : 'other'}">

                            ${escapeHtml(m.message)}

                            <span class="pp-msg-meta">

                                ${escapeHtml(
                                    m.sender?.name || ''
                                )}

                                ·

                                ${timeText(
                                    m.created_at
                                )}

                            </span>

                        </div>

                    `;

                })
                .join('');


        body.scrollTop =
            body.scrollHeight;
    }


    /*
    |--------------------------------------------------------------------------
    | User Chat
    |--------------------------------------------------------------------------
    */

    async function loadUserChat() {

        try {

            const res =
                await fetch(
                    '{{ route('chat.index') }}',
                    {
                        headers: {
                            'Accept':
                                'application/json'
                        }
                    }
                );


            if (!res.ok) {
                return;
            }


            const data =
                await res.json();


            renderMessages(
                data.messages || []
            );


            if (data.conversation) {

                selectedConversation =
                    data.conversation.id;

            }

        } catch (error) {

            console.error(
                'loadUserChat error:',
                error
            );

        }
    }


    /*
    |--------------------------------------------------------------------------
    | Render Admin List
    |--------------------------------------------------------------------------
    */

    function renderAdminList(list) {

        if (!adminList) {
            return;
        }


        if (
            !list ||
            list.length === 0
        ) {

            adminList.innerHTML = `

                <div class="pp-chat-no-user">

                    ยังไม่มีผู้ติดต่อ

                </div>

            `;

            return;
        }


        adminList.innerHTML =
            list
                .map(function (c) {

                    const selected =
                        Number(c.id)
                        === Number(
                            selectedConversation
                        );


                    const unread =
                        Number(
                            c.unread_count || 0
                        );


                    return `

                        <button
                            type="button"
                            class="pp-chat-admin-item ${
                                selected
                                    ? 'selected'
                                    : ''
                            }"
                            data-conversation="${c.id}"
                        >

                            ${
                                unread
                                ? `
                                    <span class="pp-chat-admin-unread">

                                        ${unread}

                                    </span>
                                `
                                : ''
                            }


                            <strong>

                                ${escapeHtml(
                                    c.user?.name
                                    || 'ไม่ทราบชื่อ'
                                )}

                            </strong>


                            <small>

                                ${escapeHtml(
                                    c.user?.email
                                    || ''
                                )}

                            </small>


                            <small>

                                ${
                                    c.latest_message?.message
                                    ? escapeHtml(
                                        c.latest_message.message
                                    ).substring(0, 35)
                                    : 'ยังไม่มีข้อความ'
                                }

                            </small>

                        </button>

                    `;

                })
                .join('');


        /*
        |--------------------------------------------------------------------------
        | Click User
        |--------------------------------------------------------------------------
        */

        adminList
            .querySelectorAll(
                '[data-conversation]'
            )
            .forEach(function (btn) {

                btn.addEventListener(
                    'click',
                    function () {

                        selectedConversation =
                            btn.dataset.conversation;

                        loadAdminConversation(
                            selectedConversation
                        );

                    }
                );

            });
    }


    /*
    |--------------------------------------------------------------------------
    | Load Admin Conversation
    |--------------------------------------------------------------------------
    */

    async function loadAdminConversation(id) {

        if (!id) {
            return;
        }


        try {

            /*
            |--------------------------------------------------------------------------
            | สำคัญ
            |--------------------------------------------------------------------------
            |
            | ต้องเป็น /chat/conversation/
            | ไม่ใช่ /chat/conversations/
            |
            */

            const url =
                '{{ url('/chat/conversation') }}/'
                + id;


            const res =
                await fetch(
                    url,
                    {
                        headers: {
                            'Accept':
                                'application/json'
                        }
                    }
                );


            if (!res.ok) {

                console.error(
                    'โหลด Conversation ไม่สำเร็จ',
                    res.status
                );

                return;
            }


            const data =
                await res.json();


            selectedConversation =
                data.conversation.id;


            /*
            |--------------------------------------------------------------------------
            | แสดงชื่อ User
            |--------------------------------------------------------------------------
            */

            document
                .getElementById('ppChatTitle')
                .textContent =
                    data.conversation.user?.name
                    || 'ผู้ติดต่อ';


            /*
            |--------------------------------------------------------------------------
            | แสดง Email
            |--------------------------------------------------------------------------
            */

            document
                .getElementById('ppChatSubtitle')
                .textContent =
                    data.conversation.user?.email
                    || '';


            /*
            |--------------------------------------------------------------------------
            | แสดงข้อความ
            |--------------------------------------------------------------------------
            */

            renderMessages(
                data.messages || []
            );


            /*
            |--------------------------------------------------------------------------
            | โหลดรายการใหม่
            |--------------------------------------------------------------------------
            */

            await loadAdminList();


            await updateUnread();

        } catch (error) {

            console.error(
                'loadAdminConversation error:',
                error
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Load Admin List
    |--------------------------------------------------------------------------
    */

    async function loadAdminList() {

        if (!isAdmin) {
            return;
        }


        try {

            const res =
                await fetch(
                    '{{ route('chat.index') }}',
                    {
                        headers: {
                            'Accept':
                                'application/json'
                        }
                    }
                );


            if (!res.ok) {
                return;
            }


            const data =
                await res.json();


            conversations =
                data.conversations || [];


            applySearch();


            /*
            |--------------------------------------------------------------------------
            | เลือกคนแรกอัตโนมัติ
            |--------------------------------------------------------------------------
            */

            if (
                !selectedConversation &&
                conversations.length > 0
            ) {

                selectedConversation =
                    conversations[0].id;


                await loadAdminConversation(
                    selectedConversation
                );
            }

        } catch (error) {

            console.error(
                'loadAdminList error:',
                error
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Search User
    |--------------------------------------------------------------------------
    */

    function applySearch() {

        if (!isAdmin) {
            return;
        }


        const keyword =
            searchInput
                ? searchInput.value
                    .trim()
                    .toLowerCase()
                : '';


        if (!keyword) {

            renderAdminList(
                conversations
            );

            return;
        }


        const filtered =
            conversations.filter(
                function (c) {

                    const name =
                        (
                            c.user?.name
                            || ''
                        ).toLowerCase();


                    const email =
                        (
                            c.user?.email
                            || ''
                        ).toLowerCase();


                    return (
                        name.includes(keyword)
                        ||
                        email.includes(keyword)
                    );

                }
            );


        renderAdminList(
            filtered
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Unread
    |--------------------------------------------------------------------------
    */

    async function updateUnread() {

        try {

            const res =
                await fetch(
                    '{{ route('chat.unread') }}',
                    {
                        headers: {
                            'Accept':
                                'application/json'
                        }
                    }
                );


            if (!res.ok) {
                return;
            }


            const data =
                await res.json();


            const count =
                Number(
                    data.count || 0
                );


            badge.textContent =
                count > 99
                    ? '99+'
                    : count;


            badge.style.display =
                count > 0
                    ? 'flex'
                    : 'none';

        } catch (error) {

            console.error(
                'unread error:',
                error
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Open Chat
    |--------------------------------------------------------------------------
    */

    button.addEventListener(
        'click',
        async function () {

            open = !open;


            windowEl
                .classList
                .toggle(
                    'open',
                    open
                );


            windowEl.setAttribute(
                'aria-hidden',
                String(!open)
            );


            if (!open) {
                return;
            }


            if (isAdmin) {

                await loadAdminList();

            } else {

                await loadUserChat();

            }


            await updateUnread();


            input.focus();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Close
    |--------------------------------------------------------------------------
    */

    close.addEventListener(
        'click',
        function () {

            open = false;

            windowEl
                .classList
                .remove('open');

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    if (searchInput) {

        searchInput.addEventListener(
            'input',
            function () {

                applySearch();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Send Message
    |--------------------------------------------------------------------------
    */

    form.addEventListener(
        'submit',
        async function (event) {

            event.preventDefault();


            const message =
                input.value.trim();


            if (!message) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Admin ต้องเลือก User
            |--------------------------------------------------------------------------
            */

            if (
                isAdmin &&
                !selectedConversation
            ) {

                alert(
                    'กรุณาเลือกผู้ติดต่อก่อนส่งข้อความ'
                );

                return;
            }


            try {

                const payload = {

                    message: message,

                    conversation_id:
                        isAdmin
                            ? selectedConversation
                            : null

                };


                const res =
                    await fetch(
                        '{{ route('chat.send') }}',
                        {
                            method: 'POST',

                            headers: {

                                'Content-Type':
                                    'application/json',

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    csrf

                            },

                            body:
                                JSON.stringify(
                                    payload
                                )

                        }
                    );


                if (!res.ok) {

                    const error =
                        await res.json()
                            .catch(
                                () => null
                            );


                    console.error(
                        'send error:',
                        error
                    );


                    alert(
                        error?.message
                        ||
                        'ไม่สามารถส่งข้อความได้ กรุณาลองใหม่'
                    );

                    return;
                }


                input.value = '';


                /*
                |--------------------------------------------------------------------------
                | Reload
                |--------------------------------------------------------------------------
                */

                if (isAdmin) {

                    await loadAdminConversation(
                        selectedConversation
                    );

                } else {

                    await loadUserChat();

                }


                await updateUnread();

            } catch (error) {

                console.error(
                    'send message error:',
                    error
                );


                alert(
                    'เกิดข้อผิดพลาดในการส่งข้อความ'
                );

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Auto Refresh
    |--------------------------------------------------------------------------
    |
    | ทุก 5 วินาที
    |
    */

    setInterval(
        async function () {

            /*
            |--------------------------------------------------------------------------
            | Badge
            |--------------------------------------------------------------------------
            */

            await updateUnread();


            /*
            |--------------------------------------------------------------------------
            | ถ้า Chat ปิด
            |--------------------------------------------------------------------------
            */

            if (!open) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Admin
            |--------------------------------------------------------------------------
            */

            if (isAdmin) {

                await loadAdminList();


                if (selectedConversation) {

                    await loadAdminConversation(
                        selectedConversation
                    );

                }

            }


            /*
            |--------------------------------------------------------------------------
            | User
            |--------------------------------------------------------------------------
            */

            else {

                await loadUserChat();

            }

        },
        5000
    );


    /*
    |--------------------------------------------------------------------------
    | Initial Unread
    |--------------------------------------------------------------------------
    */

    updateUnread();

})();

</script>

@endauth