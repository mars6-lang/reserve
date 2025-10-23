<!-- Chat Modal -->
<div id="chatModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="max-height: 90vh;">
            <!-- Modal Header -->
            <div class="modal-header bg-gradient" style="background: linear-gradient(135deg, #069c88 0%, #056659 100%); color: white;">
                <h5 class="modal-title" id="chatModalLabel">
                    <i class="fas fa-comments me-2"></i>My Chats
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div id="chatsList" class="chat-list">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status" style="color: #069c88 !important;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Loading chats...</p>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <a href="{{ route('chatroom.index') }}" class="btn btn-primary" style="background-color: #069c88; border-color: #069c88;">
                    <i class="fas fa-arrow-right me-2"></i>View All Chats
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    #chatModal .modal-content {
        border: none;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
        border-radius: 8px;
    }

    #chatModal .modal-header {
        border: none;
        border-radius: 8px 8px 0 0;
    }

    #chatModal .btn-close-white {
        filter: brightness(0) invert(1);
    }

    .chat-item {
        display: flex;
        align-items: center;
        padding: 12px;
        border-bottom: 1px solid #e5e7eb;
        cursor: pointer;
        transition: background-color 0.2s ease;
        text-decoration: none;
        color: inherit;
    }

    .chat-item:hover {
        background-color: #f3f4f6;
    }

    .chat-item:last-child {
        border-bottom: none;
    }

    .chat-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 12px;
        border: 2px solid #e5e7eb;
    }

    .chat-info {
        flex: 1;
    }

    .chat-name {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .chat-preview {
        font-size: 0.875rem;
        color: #6b7280;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .chat-product {
        font-size: 0.75rem;
        color: #9ca3af;
        margin-top: 2px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .chat-product img {
        width: 16px;
        height: 16px;
        border-radius: 2px;
        object-fit: cover;
    }

    .chat-time {
        font-size: 0.75rem;
        color: #9ca3af;
        white-space: nowrap;
    }

    .empty-chats {
        text-align: center;
        padding: 40px 20px;
        color: #9ca3af;
    }

    .empty-chats i {
        font-size: 3rem;
        color: #d1d5db;
        margin-bottom: 16px;
    }

    .no-chats-text {
        font-size: 1.125rem;
        color: #6b7280;
        margin-bottom: 8px;
    }

    .no-chats-subtext {
        font-size: 0.875rem;
        color: #9ca3af;
    }
</style>

<script>
    // Wait for DOM to be ready before attaching event listeners
    document.addEventListener('DOMContentLoaded', function() {
        const chatModal = document.getElementById('chatModal');
        
        if (chatModal) {
            // Attach event listener for modal show event
            chatModal.addEventListener('show.bs.modal', function() {
                console.log('Chat modal is opening, loading chats...');
                loadChats();
            });
        } else {
            console.warn('Chat modal element not found on page');
        }
    });

    function loadChats() {
        const chatsList = document.getElementById('chatsList');
        
        if (!chatsList) {
            console.error('Chat list container not found');
            return;
        }
        
        fetch('{{ route("chatroom.data") }}')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                const contacts = data.contacts || [];
                
                if (contacts && contacts.length > 0) {
                    chatsList.innerHTML = contacts.map(contact => {
                        const profilePhoto = contact.profile_photo_url || '{{ asset("images/default-user.png") }}';
                        const lastMessage = contact.latest_message || 'Start a conversation';
                        const lastMessageTime = contact.latest_message_time || '';
                        
                        let productHTML = '';
                        if (contact.product) {
                            productHTML = `
                                <div class="chat-product">
                                    <img src="{{ asset('storage') }}/${contact.product.image}" alt="Product">
                                    <span>${contact.product.title}</span>
                                </div>
                            `;
                        }
                        
                        return `
                            <a href="{{ url('/chatroom') }}/${contact.id}" class="chat-item">
                                <img src="${profilePhoto}" alt="${contact.name}" class="chat-avatar">
                                <div class="chat-info">
                                    <div class="chat-name">${contact.name}</div>
                                    <div class="chat-preview">${lastMessage}</div>
                                    ${productHTML}
                                </div>
                                ${lastMessageTime ? `<div class="chat-time">${lastMessageTime}</div>` : ''}
                            </a>
                        `;
                    }).join('');
                } else {
                    chatsList.innerHTML = `
                        <div class="empty-chats">
                            <i class="fas fa-comments"></i>
                            <p class="no-chats-text">No chats yet</p>
                            <p class="no-chats-subtext">Start a conversation by messaging a seller or buyer</p>
                            <a href="{{ route('users.Market.index') }}" class="btn btn-sm btn-outline-primary mt-3">
                                Browse Products
                            </a>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error loading chats:', error);
                chatsList.innerHTML = `
                    <div class="empty-chats">
                        <i class="fas fa-exclamation-circle"></i>
                        <p class="no-chats-text">Failed to load chats</p>
                        <p class="no-chats-subtext">Please try again later</p>
                    </div>
                `;
            });
    }
</script>
