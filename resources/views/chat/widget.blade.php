@auth

<style>

/* =========================================================
   CHAT BUTTON
========================================================= */

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

    box-shadow: 0 10px 30px rgba(0, 0, 0, .20);

    z-index: 9999;

    cursor: pointer;

    font-size: 22px;

    display: flex;
    align-items: center;
    justify-content: center;
}

.pp-chat-button:hover {
    background: #6d28d9;
}


/* =========================================================
   BADGE
========================================================= */

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


/* =========================================================
   CHAT WINDOW
========================================================= */

.pp-chat-window {
    position: fixed;

    right: 24px;
    bottom: 94px;

    width: 620px;

    max-width: calc(100vw - 32px);

    height: 560px;

    background: #fff;

    border-radius: 18px;

    box-shadow: 0 20px 60px rgba(0, 0, 0, .20);

    overflow: hidden;

    z-index: 9998;

    display: none;

    flex-direction: column;

    border: 1px solid #eee;
}


.pp-chat-window.open {
    display: flex;
}


/* =========================================================
   HEADER
========================================================= */

.pp-chat-header {
    background: #7c3aed;

    color: #fff;

    padding: 14px 16px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    flex-shrink: 0;
}


.pp-chat-header strong {
    display: block;

    font-size: 15px;

    font-weight: 700;
}


.pp-chat-header small {
    display: block;

    opacity: .85;

    font-size: 12px;

    margin-top: 2px;
}


.pp-chat-close {
    border: 0;

    background: transparent;

    color: #fff;

    font-size: 22px;

    cursor: pointer;

    width: 32px;

    height: 32px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;
}


.pp-chat-close:hover {
    background: rgba(255, 255, 255, .15);
}


/* =========================================================
   MAIN CONTENT
========================================================= */

.pp-chat-content {
    display: flex;

    flex: 1;

    min-height: 0;

    overflow: hidden;
}


/* =========================================================
   ADMIN PANEL
========================================================= */

.pp-chat-admin-panel {
    width: 220px;

    flex-shrink: 0;

    border-right: 1px solid #eee;

    background: #fff;

    display: flex;

    flex-direction: column;

    min-height: 0;
}


/* =========================================================
   SEARCH
========================================================= */

.pp-chat-search {
    padding: 10px;

    border-bottom: 1px solid #eee;

    flex-shrink: 0;
}


.pp-chat-search input {
    width: 100%;

    border: 1px solid #ddd;

    border-radius: 10px;

    padding: 8px 10px;

    outline: none;

    font-size: 13px;

    box-sizing: border-box;
}


.pp-chat-search input:focus {
    border-color: #7c3aed;

    box-shadow: 0 0 0 2px rgba(124, 58, 237, .10);
}


/* =========================================================
   ADMIN LIST
========================================================= */

.pp-chat-admin-list {
    flex: 1;

    overflow-y: auto;

    min-height: 0;
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

    box-sizing: border-box;
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

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;
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


/* =========================================================
   CHAT MAIN
========================================================= */

.pp-chat-main {
    flex: 1;

    display: flex;

    flex-direction: column;

    min-width: 0;

    min-height: 0;
}


/* =========================================================
   MESSAGE BODY
========================================================= */

.pp-chat-body {
    flex: 1;

    overflow-y: auto;

    padding: 18px 16px;

    background: #f8fafc;

    min-height: 0;

    box-sizing: border-box;
}


/* =========================================================
   MESSAGE ROW
   แยกชื่อออกจาก Bubble
========================================================= */

.pp-msg-row {
    display: flex;

    flex-direction: column;

    width: 100%;

    margin-bottom: 14px;

    /*
     * สำคัญ
     * ป้องกัน Bubble ขยายเต็มความกว้าง
     */
    align-items: flex-start;
}


/* =========================================================
   OUR MESSAGE
   อยู่ด้านขวา
========================================================= */

.pp-msg-row.me {
    align-items: flex-end;
}


/* =========================================================
   OTHER MESSAGE
   อยู่ด้านซ้าย
========================================================= */

.pp-msg-row.other {
    align-items: flex-start;
}


/* =========================================================
   SENDER NAME
   ชื่ออยู่ด้านบน Bubble
========================================================= */

.pp-msg-name {
    font-size: 11px;

    font-weight: 600;

    color: #6b7280;

    margin-bottom: 4px;

    padding: 0 6px;

    line-height: 1.3;
}


/* ชื่อของเรา */

.pp-msg-row.me .pp-msg-name {
    text-align: right;
}


/* ชื่อของอีกฝ่าย */

.pp-msg-row.other .pp-msg-name {
    text-align: left;
}


/* =========================================================
   MESSAGE BUBBLE
========================================================= */

.pp-msg-bubble {

    /*
     * สำคัญที่สุด
     * ให้กรอบมีขนาดตามข้อความ
     */
    display: inline-block;

    width: fit-content;

    /*
     * ถ้าข้อความยาวเกินพื้นที่
     * จะจำกัดความกว้างและขึ้นบรรทัดใหม่
     */
    max-width: 78%;

    padding: 10px 13px;

    border-radius: 16px;

    line-height: 1.5;

    font-size: 14px;

    /*
     * รักษาการขึ้นบรรทัดใหม่
     */
    white-space: pre-wrap;

    /*
     * ป้องกันข้อความยาวติดกัน
     */
    word-break: break-word;

    overflow-wrap: anywhere;

    /*
     * ไม่ให้ padding ทำให้ขนาดผิด
     */
    box-sizing: border-box;
}


/* =========================================================
   OUR BUBBLE
========================================================= */

.pp-msg-row.me .pp-msg-bubble {
    background: #7c3aed;

    color: #fff;

    border-bottom-right-radius: 5px;
}


/* =========================================================
   OTHER BUBBLE
========================================================= */

.pp-msg-row.other .pp-msg-bubble {
    background: #fff;

    color: #1f2937;

    border: 1px solid #e5e7eb;

    border-bottom-left-radius: 5px;

    box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
}


/* =========================================================
   MESSAGE TIME
========================================================= */

.pp-msg-time {
    display: block;

    margin-top: 5px;

    font-size: 9px;

    line-height: 1;

    opacity: .65;
}


/* เวลาในข้อความเรา */

.pp-msg-row.me .pp-msg-time {
    text-align: right;
}


/* เวลาในข้อความอีกฝ่าย */

.pp-msg-row.other .pp-msg-time {
    text-align: left;
}


/* =========================================================
   EMPTY CHAT
========================================================= */

.pp-chat-empty {
    height: 100%;

    display: flex;

    align-items: center;

    justify-content: center;

    text-align: center;

    color: #9ca3af;

    padding: 20px;

    font-size: 13px;
}


/* =========================================================
   MESSAGE FORM
========================================================= */

.pp-chat-form {
    display: flex;

    align-items: flex-end;

    gap: 8px;

    padding: 12px;

    border-top: 1px solid #eee;

    background: #fff;

    flex-shrink: 0;

    box-sizing: border-box;
}


/* =========================================================
   TEXT INPUT
========================================================= */

.pp-chat-input {
    flex: 1;

    width: 100%;

    min-height: 44px;

    max-height: 110px;

    border: 1px solid #ddd;

    border-radius: 14px;

    padding: 11px 14px;

    outline: none;

    resize: none;

    overflow-y: auto;

    font-size: 14px;

    line-height: 1.4;

    font-family: inherit;

    box-sizing: border-box;

    background: #fff;
}


.pp-chat-input:focus {
    border-color: #7c3aed;

    box-shadow: 0 0 0 2px rgba(124, 58, 237, .10);
}


.pp-chat-input::placeholder {
    color: #9ca3af;
}


/* =========================================================
   SEND BUTTON
========================================================= */

.pp-chat-send {
    width: 44px;

    height: 44px;

    flex-shrink: 0;

    border: 0;

    border-radius: 50%;

    background: #7c3aed;

    color: #fff;

    cursor: pointer;

    display: flex;

    align-items: center;

    justify-content: center;

    transition: .15s;
}


.pp-chat-send:hover {
    background: #6d28d9;

    transform: translateY(-1px);
}


.pp-chat-send:active {
    transform: scale(.95);
}


/* =========================================================
   SCROLLBAR
========================================================= */

.pp-chat-body::-webkit-scrollbar,
.pp-chat-admin-list::-webkit-scrollbar {
    width: 7px;
}


.pp-chat-body::-webkit-scrollbar-track,
.pp-chat-admin-list::-webkit-scrollbar-track {
    background: transparent;
}


.pp-chat-body::-webkit-scrollbar-thumb,
.pp-chat-admin-list::-webkit-scrollbar-thumb {
    background: #cbd5e1;

    border-radius: 10px;
}


.pp-chat-body::-webkit-scrollbar-thumb:hover,
.pp-chat-admin-list::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}


/* =========================================================
   MOBILE
========================================================= */

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


    .pp-msg-bubble {
        max-width: 82%;
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


    .pp-chat-body {
        padding: 14px 10px;
    }


    .pp-chat-form {
        padding: 8px;
    }


    .pp-msg-bubble {
        max-width: 88%;
    }

}

</style>


<!-- =========================================================
     CHAT BUTTON
========================================================= -->

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


<!-- =========================================================
     CHAT WINDOW
========================================================= -->

<div
    id="ppChatWindow"
    class="pp-chat-window"
    aria-hidden="true"
>


    <!-- =====================================================
         HEADER
    ====================================================== -->

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
            aria-label="ปิดแชต"
        >

            &times;

        </button>

    </div>


    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <div class="pp-chat-content">


        <!-- =================================================
             ADMIN USER LIST
        ================================================== -->

        @if(auth()->user()->role === 'admin')

            <div class="pp-chat-admin-panel">


                <!-- SEARCH -->

                <div class="pp-chat-search">

                    <input
                        type="text"
                        id="ppChatSearch"
                        placeholder="ค้นหาชื่อ / Email..."
                    >

                </div>


                <!-- USER LIST -->

                <div
                    id="ppChatAdminList"
                    class="pp-chat-admin-list"
                ></div>

            </div>

        @endif


        <!-- =================================================
             CHAT MAIN
        ================================================== -->

        <div class="pp-chat-main">


            <!-- =================================================
                 MESSAGE BODY
            ================================================== -->

            <div
                id="ppChatBody"
                class="pp-chat-body"
            >

                <div class="pp-chat-empty">

                    กำลังโหลดข้อความ...

                </div>

            </div>


            <!-- =================================================
                 MESSAGE FORM
            ================================================== -->

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
                    rows="1"
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

    /* =========================================================
       ELEMENTS
    ========================================================= */

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


    /* =========================================================
       USER DATA
    ========================================================= */

    const currentUserId =
        Number(@json(auth()->id()));


    const currentUserName =
        @json(auth()->user()->name);


    const isAdmin =
        @json(auth()->user()->role === 'admin');


    const csrf =
        document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute('content');


    /* =========================================================
       STATE
    ========================================================= */

    let selectedConversation = null;

    let conversations = [];

    let open = false;


    /* =========================================================
       ESCAPE HTML
    ========================================================= */

    function escapeHtml(value) {

        const div =
            document.createElement('div');


        div.textContent =
            value ?? '';


        return div.innerHTML;

    }


    /* =========================================================
       TIME
    ========================================================= */

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


    /* =========================================================
       RENDER MESSAGES
    ========================================================= */

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


                    /*
                     * ชื่อผู้ส่ง
                     */

                    let senderName =
                        m.sender?.name
                        || 'ไม่ทราบชื่อ';


                    /*
                     * ถ้าเป็นข้อความของตัวเอง
                     * ให้แสดงว่า "คุณ"
                     */

                    if (me) {

                        senderName =
                            'คุณ';

                    }


                    return `

                        <div
                            class="pp-msg-row ${
                                me
                                    ? 'me'
                                    : 'other'
                            }"
                        >


                            <!-- =================================
                                 SENDER NAME
                            ================================== -->

                            <div class="pp-msg-name">

                                ${escapeHtml(
                                    senderName
                                )}

                            </div>


                            <!-- =================================
                                 MESSAGE BUBBLE
                            ================================== -->

                            <div class="pp-msg-bubble">

                                ${escapeHtml(
                                    m.message
                                )}


                                <!-- TIME -->

                                <span class="pp-msg-time">

                                    ${timeText(
                                        m.created_at
                                    )}

                                </span>

                            </div>

                        </div>

                    `;

                })
                .join('');


        /*
         * เลื่อนไปล่างสุด
         */

        body.scrollTop =
            body.scrollHeight;

    }


    /* =========================================================
       USER CHAT
    ========================================================= */

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


    /* =========================================================
       RENDER ADMIN LIST
    ========================================================= */

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
                        ">


                            ${
                                unread
                                ? `
                                    <span
                                        class="pp-chat-admin-unread"
                                    >

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
         * Click User
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


    /* =========================================================
       LOAD ADMIN CONVERSATION
    ========================================================= */

    async function loadAdminConversation(id) {

        if (!id) {
            return;
        }


        try {

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
             * ชื่อ User บน Header
             */

            const title =
                document.getElementById(
                    'ppChatTitle'
                );


            if (title) {

                title.textContent =
                    data.conversation.user?.name
                    || 'ผู้ติดต่อ';

            }


            /*
             * Email User บน Header
             */

            const subtitle =
                document.getElementById(
                    'ppChatSubtitle'
                );


            if (subtitle) {

                subtitle.textContent =
                    data.conversation.user?.email
                    || '';

            }


            /*
             * แสดงข้อความ
             */

            renderMessages(
                data.messages || []
            );


            /*
             * Update unread
             */

            await updateUnread();


            /*
             * Update selected user
             */

            renderAdminList(
                conversations
            );

        } catch (error) {

            console.error(
                'loadAdminConversation error:',
                error
            );

        }

    }


    /* =========================================================
       LOAD ADMIN LIST
    ========================================================= */

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
             * เลือกคนแรกอัตโนมัติ
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


    /* =========================================================
       SEARCH
    ========================================================= */

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


    /* =========================================================
       UNREAD
    ========================================================= */

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


    /* =========================================================
       OPEN CHAT
    ========================================================= */

    button.addEventListener(
        'click',
        async function () {

            open =
                !open;


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


    /* =========================================================
       CLOSE CHAT
    ========================================================= */

    close.addEventListener(
        'click',
        function () {

            open =
                false;


            windowEl
                .classList
                .remove('open');


            windowEl.setAttribute(
                'aria-hidden',
                'true'
            );

        }
    );


    /* =========================================================
       SEARCH
    ========================================================= */

    if (searchInput) {

        searchInput.addEventListener(
            'input',
            function () {

                applySearch();

            }
        );

    }


    /* =========================================================
       AUTO RESIZE TEXTAREA
    ========================================================= */

    input.addEventListener(
        'input',
        function () {

            /*
             * รีเซ็ตความสูงก่อน
             */

            this.style.height =
                '44px';


            /*
             * ขยายตามข้อความ
             */

            this.style.height =
                Math.min(
                    this.scrollHeight,
                    110
                ) + 'px';

        }
    );


    /* =========================================================
       ENTER = SEND
       SHIFT + ENTER = NEW LINE
    ========================================================= */

    input.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Enter'
                &&
                !event.shiftKey
            ) {

                event.preventDefault();

                form.requestSubmit();

            }

        }
    );


    /* =========================================================
       SEND MESSAGE
    ========================================================= */

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
             * Admin ต้องเลือก User
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

                    message:
                        message,

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


                /*
                 * ล้างช่องข้อความ
                 */

                input.value =
                    '';


                input.style.height =
                    '44px';


                /*
                 * Reload Conversation
                 */

                if (isAdmin) {

                    await loadAdminConversation(
                        selectedConversation
                    );


                    await loadAdminList();

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


    /* =========================================================
       AUTO REFRESH
       ทุก 5 วินาที
    ========================================================= */

    setInterval(
        async function () {

            /*
             * Update unread
             */

            await updateUnread();


            /*
             * ถ้า Chat ปิด
             */

            if (!open) {
                return;
            }


            /*
             * ADMIN
             */

            if (isAdmin) {

                /*
                 * จำ Conversation ปัจจุบัน
                 */

                const currentConversation =
                    selectedConversation;


                /*
                 * โหลดรายการ User
                 */

                await loadAdminList();


                /*
                 * โหลด Conversation เดิม
                 */

                if (currentConversation) {

                    selectedConversation =
                        currentConversation;


                    await loadAdminConversation(
                        currentConversation
                    );

                }

            }


            /*
             * USER
             */

            else {

                await loadUserChat();

            }

        },
        5000
    );


    /* =========================================================
       INITIAL UNREAD
    ========================================================= */

    updateUnread();

})();

</script>

@endauth