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

    box-sizing: border-box;
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

    box-sizing: border-box;
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

    box-sizing: border-box;
}

.pp-chat-header strong {
    display: block;

    font-size: 15px;
}

.pp-chat-header small {
    opacity: .85;

    font-size: 12px;
}

.pp-chat-close {
    border: 0;

    background: transparent;

    color: #fff;

    font-size: 22px;

    cursor: pointer;

    padding: 0 4px;
}


/* =========================================================
   CONTENT
========================================================= */

.pp-chat-content {
    display: flex;

    flex: 1;

    min-height: 0;
    min-width: 0;
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

    box-sizing: border-box;
}

.pp-chat-search {
    padding: 10px;

    border-bottom: 1px solid #eee;

    flex-shrink: 0;

    box-sizing: border-box;
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

    min-width: 0;

    box-sizing: border-box;
}


/* =========================================================
   MESSAGE ROW
========================================================= */

.pp-msg-row {
    display: flex !important;

    flex-direction: column !important;

    width: 100% !important;

    margin-bottom: 14px;

    box-sizing: border-box;

    min-width: 0 !important;

    /* ห้ามให้ Row ทำ Bubble ยืด */
    align-items: flex-start !important;
}


/* =========================================================
   MESSAGE ALIGN
========================================================= */

.pp-msg-row.me {
    align-items: flex-end !important;
}

.pp-msg-row.other {
    align-items: flex-start !important;
}


/* =========================================================
   SENDER NAME
========================================================= */

.pp-msg-name {
    display: block;

    font-size: 11px;

    font-weight: 600;

    color: #6b7280;

    margin-bottom: 4px;

    padding: 0 6px;

    line-height: 1.3;

    box-sizing: border-box;

    max-width: 78%;
}

.pp-msg-row.me .pp-msg-name {
    text-align: right;
}

.pp-msg-row.other .pp-msg-name {
    text-align: left;
}


/* =========================================================
   MESSAGE BUBBLE
   ⭐ สำคัญที่สุด
   กรอบจะหดตามข้อความจริง
========================================================= */

.pp-msg-bubble {

    /*
     * ใช้ table เพื่อให้ Element
     * มีขนาดตาม Content จริง
     */
    display: table !important;

    /*
     * ให้ความกว้างเริ่มจากข้อความ
     */
    width: max-content !important;

    /*
     * ห้ามมีความกว้างขั้นต่ำ
     */
    min-width: 0 !important;

    /*
     * จำกัดกรอบเมื่อข้อความยาว
     */
    max-width: 78% !important;

    /*
     * ห้าม Flex ขยาย
     */
    flex: none !important;

    /*
     * ความสูงตามข้อความ
     */
    height: auto !important;

    min-height: 0 !important;

    /*
     * ป้องกัน CSS อื่น
     */
    margin: 0 !important;

    padding: 10px 13px;

    border-radius: 16px;

    line-height: 1.5;

    font-size: 14px;

    box-sizing: border-box;

    /*
     * ข้อความปกติ
     */
    white-space: normal !important;

    overflow-wrap: anywhere;

    word-break: break-word;

    vertical-align: top;
}


/* =========================================================
   MY MESSAGE
========================================================= */

.pp-msg-row.me .pp-msg-bubble {

    background: #7c3aed;

    color: #fff;

    border-bottom-right-radius: 5px;
}


/* =========================================================
   ADMIN MESSAGE
========================================================= */

.pp-msg-row.other .pp-msg-bubble {

    background: #fff;

    color: #1f2937;

    border: 1px solid #e5e7eb;

    border-bottom-left-radius: 5px;

    box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
}


/* =========================================================
   MESSAGE TEXT
========================================================= */

.pp-msg-text {

    /*
     * ไม่ให้ Text มี Width เต็ม
     */
    display: inline !important;

    width: auto !important;

    max-width: none !important;

    /*
     * รักษาการขึ้นบรรทัดของข้อความ
     */
    white-space: pre-wrap !important;

    overflow-wrap: anywhere;

    word-break: break-word;

    margin: 0 !important;

    padding: 0 !important;
}


/* =========================================================
   MESSAGE TIME
========================================================= */

.pp-msg-time {

    display: block !important;

    width: auto !important;

    height: auto !important;

    min-width: 0 !important;

    min-height: 0 !important;

    margin-top: 5px;

    font-size: 9px;

    line-height: 1;

    opacity: .65;

    white-space: nowrap;

    box-sizing: border-box;

    text-align: right;
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

    box-sizing: border-box;
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
   INPUT
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

    box-shadow:
        0 0 0 2px rgba(124, 58, 237, .10);
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

        max-width: 82% !important;
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

        max-width: 88% !important;
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

                <div class="pp-chat-search">

                    <input
                        type="text"
                        id="ppChatSearch"
                        placeholder="ค้นหาชื่อ / Email..."
                    >

                </div>

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
                    aria-label="ส่งข้อความ"
                >

                    <i class="fa-solid fa-paper-plane"></i>

                </button>

            </form>

        </div>

    </div>

</div>


<script>

(function () {

    'use strict';


    /* =========================================================
       ELEMENTS
    ========================================================= */

    const button =
        document.getElementById('ppChatButton');

    const windowEl =
        document.getElementById('ppChatWindow');

    const closeButton =
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

    let chatOpen = false;

    let loadingConversation = false;


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

        const date =
            new Date(dateString);

        if (Number.isNaN(date.getTime())) {
            return '';
        }

        return date.toLocaleTimeString(
            'th-TH',
            {
                hour: '2-digit',
                minute: '2-digit'
            }
        );
    }


    /* =========================================================
       RENDER MESSAGES
       ⭐ จุดสำคัญ
       ไม่มีช่องว่างรอบ m.message
       เพื่อไม่ให้ pre-wrap เพิ่มความกว้าง
    ========================================================= */

    function renderMessages(messages) {

        if (
            !messages ||
            messages.length === 0
        ) {

            body.innerHTML =
                '<div class="pp-chat-empty">' +
                    'ยังไม่มีข้อความ<br>' +
                    'เริ่มพูดคุยได้เลยครับ 😊' +
                '</div>';

            return;
        }


        const html =
            messages
                .map(function (m) {

                    const me =
                        Number(m.sender_id)
                        === currentUserId;


                    const senderName =
                        me
                            ? 'คุณ'
                            : (
                                m.sender?.name
                                || 'ไม่ทราบชื่อ'
                            );


                    const safeMessage =
                        escapeHtml(
                            m.message
                        );


                    const safeTime =
                        escapeHtml(
                            timeText(
                                m.created_at
                            )
                        );


                    /*
                     * สำคัญ:
                     * ไม่ใส่ whitespace/newline
                     * ระหว่าง span กับข้อความ
                     */

                    return (
                        '<div class="pp-msg-row ' +
                            (me ? 'me' : 'other') +
                        '">' +

                            '<div class="pp-msg-name">' +
                                escapeHtml(
                                    senderName
                                ) +
                            '</div>' +

                            '<div class="pp-msg-bubble">' +

                                '<span class="pp-msg-text">' +
                                    safeMessage +
                                '</span>' +

                                '<span class="pp-msg-time">' +
                                    safeTime +
                                '</span>' +

                            '</div>' +

                        '</div>'
                    );

                })
                .join('');


        body.innerHTML = html;


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
                        method: 'GET',

                        headers: {
                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest'
                        },

                        cache: 'no-store'
                    }
                );


            if (!res.ok) {

                console.error(
                    'loadUserChat:',
                    res.status
                );

                return;
            }


            const data =
                await res.json();


            if (data.conversation) {

                selectedConversation =
                    data.conversation.id;

            }


            renderMessages(
                data.messages || []
            );

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

            adminList.innerHTML =
                '<div class="pp-chat-no-user">' +
                    'ยังไม่มีผู้ติดต่อ' +
                '</div>';

            return;
        }


        adminList.innerHTML =
            list
                .map(function (conversation) {

                    const selected =
                        Number(
                            conversation.id
                        )
                        ===
                        Number(
                            selectedConversation
                        );


                    const unread =
                        Number(
                            conversation.unread_count
                            || 0
                        );


                    const userName =
                        conversation.user?.name
                        || 'ไม่ทราบชื่อ';


                    const userEmail =
                        conversation.user?.email
                        || '';


                    let preview =
                        'ยังไม่มีข้อความ';


                    if (
                        conversation.latest_message
                        &&
                        conversation.latest_message.message
                    ) {

                        preview =
                            conversation
                                .latest_message
                                .message;

                        preview =
                            preview.length > 35
                                ? preview.substring(
                                    0,
                                    35
                                ) + '...'
                                : preview;
                    }


                    return (

                        '<button ' +
                            'type="button" ' +
                            'class="pp-chat-admin-item ' +
                                (
                                    selected
                                        ? 'selected'
                                        : ''
                                ) +
                            '" ' +
                            'data-conversation="' +
                                conversation.id +
                            '"' +
                        '>' +

                            (
                                unread > 0
                                    ? (
                                        '<span ' +
                                            'class="pp-chat-admin-unread"' +
                                        '>' +
                                            (
                                                unread > 99
                                                    ? '99+'
                                                    : unread
                                            ) +
                                        '</span>'
                                    )
                                    : ''
                            ) +

                            '<strong>' +
                                escapeHtml(
                                    userName
                                ) +
                            '</strong>' +

                            '<small>' +
                                escapeHtml(
                                    userEmail
                                ) +
                            '</small>' +

                            '<small>' +
                                escapeHtml(
                                    preview
                                ) +
                            '</small>' +

                        '</button>'
                    );

                })
                .join('');


        adminList
            .querySelectorAll(
                '[data-conversation]'
            )
            .forEach(function (btn) {

                btn.addEventListener(
                    'click',
                    async function () {

                        selectedConversation =
                            btn.dataset.conversation;

                        await loadAdminConversation(
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

        if (!id || loadingConversation) {
            return;
        }


        loadingConversation = true;


        try {

            const url =
                '{{ url('/chat/conversation') }}/'
                + encodeURIComponent(id);


            const res =
                await fetch(
                    url,
                    {
                        method: 'GET',

                        headers: {
                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest'
                        },

                        cache: 'no-store'
                    }
                );


            if (!res.ok) {

                console.error(
                    'โหลด Conversation ไม่สำเร็จ:',
                    res.status
                );

                return;
            }


            const data =
                await res.json();


            if (!data.conversation) {
                return;
            }


            selectedConversation =
                data.conversation.id;


            const title =
                document.getElementById(
                    'ppChatTitle'
                );


            const subtitle =
                document.getElementById(
                    'ppChatSubtitle'
                );


            if (title) {

                title.textContent =
                    data.conversation.user?.name
                    || 'ผู้ติดต่อ';
            }


            if (subtitle) {

                subtitle.textContent =
                    data.conversation.user?.email
                    || '';
            }


            renderMessages(
                data.messages || []
            );


            /*
             * อัปเดตสี Selected
             */

            renderAdminList(
                conversations
            );


        } catch (error) {

            console.error(
                'loadAdminConversation error:',
                error
            );

        } finally {

            loadingConversation = false;
        }
    }


    /* =========================================================
       LOAD ADMIN LIST
    ========================================================= */

    async function loadAdminList() {

        if (!isAdmin || !adminList) {
            return;
        }


        try {

            const res =
                await fetch(
                    '{{ route('chat.index') }}',
                    {
                        method: 'GET',

                        headers: {
                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest'
                        },

                        cache: 'no-store'
                    }
                );


            if (!res.ok) {

                console.error(
                    'loadAdminList:',
                    res.status
                );

                return;
            }


            const data =
                await res.json();


            conversations =
                data.conversations || [];


            applySearch();


            /*
             * ถ้ายังไม่ได้เลือก
             * ให้เลือกคนแรก
             */

            if (
                !selectedConversation
                &&
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

        if (!isAdmin || !adminList) {
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
                function (conversation) {

                    const name =
                        (
                            conversation.user?.name
                            || ''
                        )
                        .toLowerCase();


                    const email =
                        (
                            conversation.user?.email
                            || ''
                        )
                        .toLowerCase();


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

        if (!badge) {
            return;
        }


        try {

            const res =
                await fetch(
                    '{{ route('chat.unread') }}',
                    {
                        method: 'GET',

                        headers: {
                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest'
                        },

                        cache: 'no-store'
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
                    : String(count);


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

    if (button) {

        button.addEventListener(
            'click',
            async function () {

                chatOpen =
                    !chatOpen;


                windowEl
                    .classList
                    .toggle(
                        'open',
                        chatOpen
                    );


                windowEl.setAttribute(
                    'aria-hidden',
                    String(!chatOpen)
                );


                if (!chatOpen) {
                    return;
                }


                if (isAdmin) {

                    await loadAdminList();

                } else {

                    await loadUserChat();

                }


                await updateUnread();


                if (input) {
                    input.focus();
                }

            }
        );
    }


    /* =========================================================
       CLOSE CHAT
    ========================================================= */

    if (closeButton) {

        closeButton.addEventListener(
            'click',
            function () {

                chatOpen = false;


                windowEl
                    .classList
                    .remove('open');


                windowEl.setAttribute(
                    'aria-hidden',
                    'true'
                );

            }
        );
    }


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

    if (input) {

        input.addEventListener(
            'input',
            function () {

                this.style.height =
                    '44px';


                this.style.height =
                    Math.min(
                        this.scrollHeight,
                        110
                    ) + 'px';

            }
        );
    }


    /* =========================================================
       ENTER = SEND
       SHIFT + ENTER = NEW LINE
    ========================================================= */

    if (input) {

        input.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Enter'
                    &&
                    !event.shiftKey
                ) {

                    event.preventDefault();


                    if (form) {
                        form.requestSubmit();
                    }

                }

            }
        );
    }


    /* =========================================================
       SEND MESSAGE
    ========================================================= */

    if (form) {

        form.addEventListener(
            'submit',
            async function (event) {

                event.preventDefault();


                const message =
                    input
                        ? input.value.trim()
                        : '';


                if (!message) {
                    return;
                }


                /*
                 * Admin ต้องเลือก Conversation
                 */

                if (
                    isAdmin
                    &&
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
                                        csrf,

                                    'X-Requested-With':
                                        'XMLHttpRequest'

                                },

                                body:
                                    JSON.stringify(
                                        payload
                                    )
                            }
                        );


                    const data =
                        await res.json()
                            .catch(
                                function () {
                                    return {};
                                }
                            );


                    if (!res.ok) {

                        console.error(
                            'send error:',
                            data
                        );


                        alert(
                            data.message
                            ||
                            'ไม่สามารถส่งข้อความได้ กรุณาลองใหม่'
                        );

                        return;
                    }


                    /*
                     * ล้าง Input
                     */

                    input.value = '';

                    input.style.height =
                        '44px';


                    /*
                     * โหลดข้อความใหม่
                     */

                    if (isAdmin) {

                        if (
                            selectedConversation
                        ) {

                            await loadAdminConversation(
                                selectedConversation
                            );
                        }


                        await loadAdminList();

                    } else {

                        await loadUserChat();

                    }


                    await updateUnread();


                    input.focus();

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
    }


    /* =========================================================
       AUTO REFRESH
       ทุก 5 วินาที
    ========================================================= */

    setInterval(
        async function () {

            await updateUnread();


            /*
             * ถ้าปิด Chat
             * ไม่ต้องโหลดข้อความ
             */

            if (!chatOpen) {
                return;
            }


            if (isAdmin) {

                const currentConversation =
                    selectedConversation;


                await loadAdminList();


                /*
                 * โหลด Conversation เดิม
                 */

                if (
                    currentConversation
                ) {

                    selectedConversation =
                        currentConversation;


                    await loadAdminConversation(
                        currentConversation
                    );
                }

            } else {

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