<!-- Modern Chatbot Component - New Design -->
<div id="chatbot-container" class="fixed bottom-6 right-6 z-50">
    <!-- Chatbot Toggle Button -->
    <button id="chatbot-toggle" aria-label="Open chat assistant" class="group bg-gradient-to-r from-[#B9FF66] to-[#a7e85c] text-black p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-[#B9FF66]/50 focus:ring-offset-2">
        <img src="{{ asset('images/svg/AI-BOT-Photoroom.png') }}" alt="AI Chatbot Icon" class="h-10 w-10 object-contain transition-transform duration-300 group-hover:scale-110">
    </button>
    
    <!-- Bot hint message -->
    <div id="bot-hint" class="absolute bottom-20 right-0 bg-white p-3 rounded-xl shadow-lg max-w-[250px] animate-fade-in border border-gray-200">
        <div class="flex items-start gap-2.5">
            <div class="flex-shrink-0 mt-0.5">
                <div class="w-2 h-2 rounded-full bg-[#B9FF66]"></div>
            </div>
            <p class="text-sm font-medium text-gray-700"><span class="font-semibold">👋 Need help?</span> I'm your Smart Assistant!</p>
        </div>
        <div class="absolute -bottom-1.5 right-5 w-3 h-3 bg-white transform rotate-45 border-r border-b border-gray-200"></div>
    </div>

    <!-- Chatbot Window -->
    <div id="chatbot-window" class="hidden absolute bottom-20 right-0 w-[324px] md:w-[364px] bg-white rounded-2xl shadow-2xl overflow-hidden transition-all duration-300 transform origin-bottom-right scale-95 opacity-0 border border-gray-200">
        <!-- Header -->
        <div class="bg-white p-3.5 flex items-center justify-between border-b border-gray-200">
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('images/svg/AI-BOT-Photoroom.png') }}" alt="AI Chatbot" class="h-12 w-12 object-contain p-1 bg-gray-100 rounded-full">
                <div>
                    <h3 class="font-semibold text-base text-gray-800">Smart Assistant</h3>
                    <div class="flex items-center">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>
                        <p class="text-xs text-gray-500">Online</p>
                    </div>
                </div>
            </div>
            <button id="chatbot-close" aria-label="Close chat" class="text-gray-400 hover:text-gray-600 p-1.5 rounded-full hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Main Content Area -->
        <div class="flex flex-col h-[445px] bg-gray-50">
            <!-- Chat Messages (Scrollable) -->
            <div id="chat-messages" class="flex-1 p-4 space-y-4 overflow-y-auto scroll-smooth">
                <!-- Welcome Message (Initial Bot Message) -->
                <div class="flex items-start gap-2.5 animate-fade-in-up">
                    <div class="flex-shrink-0 mt-1">
                        <div class="bg-white p-1 rounded-full shadow-sm border border-gray-200">
                            <img src="{{ asset('images/svg/AI-BOT-Photoroom.png') }}" alt="AI Chatbot" class="h-6 w-6 object-contain">
                        </div>
                    </div>
                    <div class="bg-gray-200 text-gray-800 p-3 rounded-xl rounded-tl-none shadow-sm max-w-[85%]">
                        <p class="text-sm leading-relaxed">Hi! I'm your Smart Assistant. I can help you with questions about CV processing, job matching, and platform features. How can I assist you today?</p>
                    </div>
                </div>
            </div>

            <!-- Quick Questions -->
            <div class="px-4 pt-2 pb-3 border-t border-gray-200 bg-white">
                <p class="text-xs font-medium text-gray-500 mb-2">Or try these quick questions:</p>
                <div id="quick-questions-container" class="flex flex-wrap gap-1.5">
                    <!-- Static examples, will be replaced by JS -->
                    <button class="quick-question text-xs py-1 px-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full transition-colors focus:outline-none focus:ring-1 focus:ring-[#B9FF66]/80" data-question="How does CV processing work?">CV processing?</button>
                    <button class="quick-question text-xs py-1 px-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full transition-colors focus:outline-none focus:ring-1 focus:ring-[#B9FF66]/80" data-question="How does job matching work?">Job matching?</button>
                    <button class="quick-question text-xs py-1 px-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full transition-colors focus:outline-none focus:ring-1 focus:ring-[#B9FF66]/80" data-question="How do I manage my account?">Manage account?</button>
                </div>
            </div>

            <!-- Input Area -->
            <div class="p-3 border-t border-gray-200 bg-gray-100">
                <div class="chat-input-group-wrapper flex items-center gap-2 bg-white rounded-full p-1.5 shadow-sm focus-within:ring-0 focus-within:border-transparent">
                    <input type="text" id="chat-input" placeholder="Type your message..." class="flex-1 bg-transparent px-3 py-1.5 text-sm border-none focus:outline-none focus:ring-0 placeholder-gray-400 text-gray-800" aria-label="Type your message">
                    <button id="send-message" aria-label="Send message" class="bg-[#B9FF66] text-black p-2 rounded-full hover:bg-[#a7e85c] transition-colors focus:outline-none focus:ring-2 focus:ring-[#B9FF66]/50 focus:ring-offset-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </div>
                <div class="text-center mt-2.5">
                    <span class="text-[10px] text-gray-400">Powered by Smart Connect AI</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Animations */
@keyframes floatBot {
    0% { transform: translateY(0) rotate(0); }
    25% { transform: translateY(-3px) rotate(-2deg); }
    50% { transform: translateY(-5px) rotate(0); }
    75% { transform: translateY(-3px) rotate(2deg); }
    100% { transform: translateY(0) rotate(0); }
}
.animate-float {
    animation: floatBot 4s ease-in-out infinite;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
.animate-fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fadeInUp 0.5s ease-out forwards;
}

/* Custom scrollbar for chat messages (optional) */
#chat-messages::-webkit-scrollbar {
    width: 6px;
}
#chat-messages::-webkit-scrollbar-track {
    background: transparent;
}
#chat-messages::-webkit-scrollbar-thumb {
    background-color: rgba(0,0,0,0.2);
    border-radius: 3px;
}
#chat-messages {
    scrollbar-width: thin;
    scrollbar-color: rgba(0,0,0,0.2) transparent;
}


/* Responsive adjustments */
@media (max-width: 640px) {
    #chatbot-window {
        width: calc(100vw - 24px) !important; /* Slightly more padding from edges */
        right: 12px !important;
        left: auto !important; /* Ensure it aligns to right */
        bottom: 80px !important; /* Ensure it's above the toggle button if screen is small */
    }
    #chatbot-toggle {
        bottom: 16px;
        right: 16px;
    }
    #bot-hint {
        max-width: calc(100vw - 40px);
        right: 12px;
        bottom: 80px; /* Adjust if toggle moves */
    }
}

/* Force remove border on input group focus */
.chat-input-group-wrapper:focus-within {
    border: 1px solid transparent !important;
    box-shadow: none !important;
    outline: none !important;
}
#chat-input:focus {
    border-color: transparent !important;
    border-width: 0 !important;
    border-style: none !important;
    box-shadow: none !important;
    outline: none !important;
    outline-offset: 0 !important; /* Explicitly set outline offset */
    -webkit-appearance: none !important; /* Attempt to remove browser default styling */
    -moz-appearance: none !important;
    appearance: none !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatbotToggle = document.getElementById('chatbot-toggle');
    const chatbotWindow = document.getElementById('chatbot-window');
    const chatbotClose = document.getElementById('chatbot-close');
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-message');
    const chatMessages = document.getElementById('chat-messages');
    const quickQuestionsContainer = document.getElementById('quick-questions-container');
    
    chatbotToggle.classList.add('animate-float');

    chatbotToggle.addEventListener('click', function() {
        if (chatbotWindow.classList.contains('hidden')) {
            chatbotWindow.classList.remove('hidden');
            setTimeout(() => {
                chatbotWindow.classList.remove('scale-95', 'opacity-0');
                chatbotWindow.classList.add('scale-100', 'opacity-100');
                setTimeout(() => chatInput.focus(), 300);
                loadQuickQuestions(); // Load fresh questions each time or cache as needed
            }, 50);
        } else {
            chatbotWindow.classList.remove('scale-100', 'opacity-100');
            chatbotWindow.classList.add('scale-95', 'opacity-0');
            setTimeout(() => chatbotWindow.classList.add('hidden'), 300);
        }
    });

    chatbotClose.addEventListener('click', function() {
        chatbotWindow.classList.remove('scale-100', 'opacity-100');
        chatbotWindow.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            chatbotWindow.classList.add('hidden');
        }, 300);
    });
    
    function loadQuickQuestions() {
        console.log('Loading quick questions...');
        
        fetch('{{ route('chatbot.quick-questions') }}')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Quick questions loaded:', data);
                
                if (data.questions && data.questions.length > 0) {
                    // Show the parent div and heading
                    const parentDiv = quickQuestionsContainer.parentElement;
                    const headingP = parentDiv.querySelector('p');
                    if (headingP) headingP.classList.remove('hidden');
                    parentDiv.classList.remove('hidden');
                    
                    // Clear existing questions
                    quickQuestionsContainer.innerHTML = '';
                    
                    // Add each question
                    data.questions.forEach(questionText => {
                        const button = document.createElement('button');
                        button.className = 'quick-question text-xs py-1 px-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full transition-colors focus:outline-none focus:ring-1 focus:ring-[#B9FF66]/80';
                        button.dataset.question = questionText;
                        
                        // Format display text: shorter version for display
                        const displayText = questionText.length > 25 ? questionText.substring(0, 22) + '...' : questionText;
                        button.textContent = displayText;
                        button.title = questionText; // Full text on hover
                        
                        // Log for debugging
                        console.log('Creating quick question button:', questionText);
                        
                        // Add click event with proper handling
                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            console.log('Quick question clicked:', this.dataset.question);
                            // Use the full question text from dataset, not the shortened display text
                            const question = this.dataset.question;
                            addMessage(question, 'user');
                            chatInput.value = ''; // Clear input
                            fetchChatbotResponse(question);
                            
                            // Optional: hide quick questions after selection
                            // parentDiv.classList.add('hidden');
                        });
                        
                        quickQuestionsContainer.appendChild(button);
                    });
                } else {
                    console.log('No quick questions available');
                    // Hide the section if no questions
                    const parentDiv = quickQuestionsContainer.parentElement;
                    if (parentDiv) parentDiv.classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error loading quick questions:', error);
                // Show error in console but don't break the UI
                const parentDiv = quickQuestionsContainer.parentElement;
                if (parentDiv) parentDiv.classList.add('hidden');
                
                // Add fallback questions if API fails
                addFallbackQuickQuestions();
            });
    }
    
    // Fallback quick questions if API fails
    function addFallbackQuickQuestions() {
        console.log('Adding fallback quick questions');
        
        const fallbackQuestions = [
            'How does CV processing work?',
            'How does job matching work?',
            'How do I manage my account?',
            'Is my data safe?'
        ];
        
        quickQuestionsContainer.innerHTML = '';
        
        fallbackQuestions.forEach(questionText => {
            const button = document.createElement('button');
            button.className = 'quick-question text-xs py-1 px-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full transition-colors focus:outline-none focus:ring-1 focus:ring-[#B9FF66]/80';
            button.dataset.question = questionText;
            button.textContent = questionText.length > 25 ? questionText.substring(0, 22) + '...' : questionText;
            button.title = questionText;
            
            button.addEventListener('click', function() {
                const question = this.dataset.question;
                addMessage(question, 'user');
                chatInput.value = '';
                fetchChatbotResponse(question);
            });
            
            quickQuestionsContainer.appendChild(button);
        });
        
        // Show the parent div since we've added fallback questions
        const parentDiv = quickQuestionsContainer.parentElement;
        if (parentDiv) {
            parentDiv.classList.remove('hidden');
            const headingP = parentDiv.querySelector('p');
            if (headingP) headingP.classList.remove('hidden');
        }
    }

    function sendMessage() {
        const message = chatInput.value.trim();
        if (message) {
            addMessage(message, 'user');
            chatInput.value = '';
            fetchChatbotResponse(message);

            // Hide quick questions section if it exists and a typed message was sent
            if (quickQuestionsContainer && quickQuestionsContainer.parentElement) {
                quickQuestionsContainer.parentElement.classList.add('hidden');
            }
        }
    }

    function fetchChatbotResponse(message) {
        console.log('Fetching response for message:', message);
        
        // Show typing indicator
        const typingIndicator = document.createElement('div');
        typingIndicator.id = 'typing-indicator';
        typingIndicator.className = 'flex items-start gap-2.5 animate-fade-in-up';
        typingIndicator.innerHTML = `
            <div class="flex-shrink-0 mt-1">
                <div class="bg-white p-1 rounded-full shadow-sm border border-gray-200">
                    <img src="{{ asset('images/svg/AI-BOT-Photoroom.png') }}" alt="AI Chatbot" class="h-6 w-6 object-contain">
                </div>
            </div>
            <div class="bg-gray-200 text-gray-800 p-3 rounded-xl rounded-tl-none shadow-sm">
                <div class="flex items-center space-x-1.5">
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                </div>
            </div>
        `;
        chatMessages.appendChild(typingIndicator);
        scrollToBottom();

        // For quick questions, store exact original question
        const exactQuestion = message;
        
        // Trim message if it's too long
        if (message.length > 500) {
            message = message.substring(0, 497) + '...';
        }

        fetch('{{ route('chatbot.response') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                message: message,
                exact_question: exactQuestion
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Response received:', data);
            
            // Remove typing indicator
            const indicator = document.getElementById('typing-indicator');
            if (indicator) indicator.remove();
            
            // Check if response exists
            if (data && data.response) {
                // Add a slight delay for natural feel
                setTimeout(() => addMessage(data.response, 'bot'), 200);
            } else {
                console.error('Invalid response format:', data);
                addMessage("I apologize, but I couldn't find an answer to your question.", 'bot');
            }
        })
        .catch(error => {
            console.error('Error fetching response:', error);
            
            // Remove typing indicator
            const indicator = document.getElementById('typing-indicator');
            if (indicator) indicator.remove();
            
            // Show error message
            addMessage("I'm sorry, I couldn't process your request at the moment. Please try again later.", 'bot');
        });
    }
    
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    sendButton.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Prevent form submission if inside a form
            sendMessage();
        }
    });

    // Initial setup for static quick questions (will be overridden by dynamic load if successful)
    document.querySelectorAll('.quick-question').forEach(button => {
        button.addEventListener('click', function() {
            const question = this.dataset.question;
            addMessage(question, 'user');
            chatInput.value = '';
            fetchChatbotResponse(question);
        });
    });

    function addMessage(message, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'animate-fade-in-up'; // Animation class on the wrapper

        let formattedMessage = message;
        if (sender === 'bot') {
            formattedMessage = message
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>') // Bold
                .replace(/\*(.*?)\*/g, '<em>$1</em>')       // Italic
                .replace(/```([\s\S]*?)```/g, '<pre class="bg-gray-800 text-white p-2 rounded-md text-xs my-1 overflow-x-auto"><code>$1</code></pre>') // Code block
                .replace(/`([^`]+)`/g, '<code class="bg-gray-200 text-red-600 px-1 rounded text-xs">$1</code>') // Inline code
                .replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank" class="text-blue-600 hover:underline">$1</a>') // Link
                .replace(/(?:\r\n|\r|\n)/g, '<br>'); // Line breaks
        }

        if (sender === 'user') {
            messageDiv.classList.add('flex', 'items-start', 'gap-2.5', 'justify-end');
            messageDiv.innerHTML = `
                <div class="bg-[#B9FF66] text-black p-3 rounded-xl rounded-tr-none shadow-sm max-w-[85%]">
                    <p class="text-sm leading-relaxed">${message}</p>
                </div>
                <div class="flex-shrink-0 mt-1">
                    <div class="p-1.5 bg-black rounded-full flex items-center justify-center w-7 h-7">
                        <span class="text-xs font-bold text-[#B9FF66]">YOU</span>
                    </div>
                </div>
            `;
        } else { // Bot or typing indicator
            messageDiv.classList.add('flex', 'items-start', 'gap-2.5');
            messageDiv.innerHTML = `
                <div class="flex-shrink-0 mt-1">
                    <div class="bg-white p-1 rounded-full shadow-sm border border-gray-200">
                        <img src="{{ asset('images/svg/AI-BOT-Photoroom.png') }}" alt="AI Chatbot" class="h-6 w-6 object-contain">
                    </div>
                </div>
                <div class="bg-gray-200 text-gray-800 p-3 rounded-xl rounded-tl-none shadow-sm max-w-[85%]">
                    <p class="text-sm leading-relaxed">${formattedMessage}</p>
                </div>
            `;
        }
        
        chatMessages.appendChild(messageDiv);
        scrollToBottom();
    }
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.altKey && e.key === '/') {
            e.preventDefault();
            chatbotToggle.click();
        }
        if (e.key === 'Escape' && !chatbotWindow.classList.contains('hidden')) {
            e.preventDefault();
            chatbotClose.click();
        }
    });

    // Accessibility announcement (kept from original, good practice)
    function announceForScreenReaders(message) {
        const announcement = document.createElement('div');
        announcement.setAttribute('aria-live', 'polite');
        announcement.classList.add('sr-only'); // Tailwind class for screen-reader only
        announcement.textContent = message;
        document.body.appendChild(announcement);
        setTimeout(() => document.body.removeChild(announcement), 1000);
    }

    // Announce chatbot availability on load
    // announceForScreenReaders("Chat assistant available. Press Alt + / to open.");
});
</script>