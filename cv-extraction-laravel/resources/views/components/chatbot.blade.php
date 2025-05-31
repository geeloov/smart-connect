<!-- Chatbot Component -->
<div id="chatbot-container" class="fixed bottom-6 right-6 z-50">
    <!-- Chatbot Toggle Button -->
    <button id="chatbot-toggle" class="bg-[#B9FF66] hover:bg-[#a7e85c] text-[#191A23] p-4 rounded-full shadow-lg border-2 border-[#191A23] transition-all duration-200 transform hover:-translate-y-1" style="box-shadow: 0px 4px 0px 0 #191a23;">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
    </button>

    <!-- Chatbot Window -->
    <div id="chatbot-window" class="hidden absolute bottom-16 right-0 w-80 h-96 bg-white rounded-2xl border-2 border-[#191A23] shadow-xl" style="box-shadow: 0px 8px 0px 0 #191a23;">
        <!-- Header -->
        <div class="bg-[#B9FF66] p-4 rounded-t-xl border-b-2 border-[#191A23]">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-[#191A23] rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-[#191A23]">Smart Assistant</h3>
                        <p class="text-xs text-[#191A23]/70">Ask me anything!</p>
                    </div>
                </div>
                <button id="chatbot-close" class="text-[#191A23] hover:text-[#191A23]/70">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Chat Messages -->
        <div id="chat-messages" class="flex-1 p-4 h-64 overflow-y-auto space-y-3">
            <!-- Welcome Message -->
            <div class="flex items-start gap-2">
                <div class="p-2 bg-[#B9FF66] rounded-lg border border-[#191A23]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <div class="bg-[#191A23]/5 rounded-lg p-3 max-w-xs">
                    <p class="text-sm text-[#191A23]">Hi! I'm your Smart Assistant. I can help you with common questions about the platform. What would you like to know?</p>
                </div>
            </div>
        </div>

        <!-- Quick Questions -->
        <div class="p-4 border-t border-[#191A23]/10">
            <p class="text-xs text-[#191A23]/70 mb-2">Quick questions:</p>
            <div class="space-y-2">
                <button class="quick-question w-full text-left text-xs bg-[#191A23]/5 hover:bg-[#B9FF66]/20 p-2 rounded-lg transition-colors" data-question="How do I upload a CV?">
                    How do I upload a CV?
                </button>
                <button class="quick-question w-full text-left text-xs bg-[#191A23]/5 hover:bg-[#B9FF66]/20 p-2 rounded-lg transition-colors" data-question="How does job matching work?">
                    How does job matching work?
                </button>
                <button class="quick-question w-full text-left text-xs bg-[#191A23]/5 hover:bg-[#B9FF66]/20 p-2 rounded-lg transition-colors" data-question="How do I create a job position?">
                    How do I create a job position?
                </button>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 border-t border-[#191A23]/10">
            <div class="flex gap-2">
                <input type="text" id="chat-input" placeholder="Type your question..." class="flex-1 px-3 py-2 text-sm border border-[#191A23]/20 rounded-lg focus:outline-none focus:border-[#B9FF66] focus:ring-1 focus:ring-[#B9FF66]">
                <button id="send-message" class="bg-[#B9FF66] hover:bg-[#a7e85c] text-[#191A23] p-2 rounded-lg border border-[#191A23] transition-colors" style="box-shadow: 0px 2px 0px 0 #191a23;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatbotToggle = document.getElementById('chatbot-toggle');
    const chatbotWindow = document.getElementById('chatbot-window');
    const chatbotClose = document.getElementById('chatbot-close');
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-message');
    const chatMessages = document.getElementById('chat-messages');
    const quickQuestions = document.querySelectorAll('.quick-question');

    // Predefined responses
    const responses = {
        "how do i upload a cv?": "To upload a CV, go to your profile section and click on 'Upload CV'. You can upload PDF files up to 10MB. The system will automatically extract information from your CV.",
        "how does job matching work?": "Our AI analyzes your CV and compares it with job requirements. It looks at skills, experience, education, and other factors to calculate a compatibility score between 0-100%.",
        "how do i create a job position?": "As a recruiter, click on 'Post New Job' from your dashboard. Fill in the job details including title, description, requirements, and location. The position will be active once published.",
        "what file formats are supported?": "Currently, we support PDF files for CV uploads. Make sure your file is under 10MB for optimal processing.",
        "how accurate is the ai analysis?": "Our AI has been trained on thousands of CVs and job descriptions. While very accurate, we recommend reviewing the extracted information and making adjustments if needed.",
        "can i edit extracted information?": "Yes, after the AI processes your CV, you can review and edit any extracted information before saving it to your profile.",
        "how do i apply for jobs?": "Browse available jobs from your dashboard, click on a position that interests you, and click 'Apply'. You can choose which CV to use for your application.",
        "default": "I'm here to help! You can ask me about uploading CVs, job matching, creating positions, or any other platform features. Try asking one of the quick questions above!"
    };

    // Toggle chatbot
    chatbotToggle.addEventListener('click', function() {
        chatbotWindow.classList.toggle('hidden');
    });

    // Close chatbot
    chatbotClose.addEventListener('click', function() {
        chatbotWindow.classList.add('hidden');
    });

    // Send message
    function sendMessage() {
        const message = chatInput.value.trim();
        if (message) {
            addMessage(message, 'user');
            chatInput.value = '';
            
            // Simulate thinking delay
            setTimeout(() => {
                const response = getResponse(message);
                addMessage(response, 'bot');
            }, 500);
        }
    }

    sendButton.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    // Quick questions
    quickQuestions.forEach(button => {
        button.addEventListener('click', function() {
            const question = this.dataset.question;
            addMessage(question, 'user');
            
            setTimeout(() => {
                const response = getResponse(question);
                addMessage(response, 'bot');
            }, 500);
        });
    });

    // Add message to chat
    function addMessage(message, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex items-start gap-2';
        
        if (sender === 'user') {
            messageDiv.innerHTML = `
                <div class="flex-1"></div>
                <div class="bg-[#B9FF66] rounded-lg p-3 max-w-xs border border-[#191A23]">
                    <p class="text-sm text-[#191A23]">${message}</p>
                </div>
                <div class="p-2 bg-[#191A23] rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            `;
        } else {
            messageDiv.innerHTML = `
                <div class="p-2 bg-[#B9FF66] rounded-lg border border-[#191A23]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <div class="bg-[#191A23]/5 rounded-lg p-3 max-w-xs">
                    <p class="text-sm text-[#191A23]">${message}</p>
                </div>
            `;
        }
        
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Get response based on message
    function getResponse(message) {
        const lowerMessage = message.toLowerCase();
        
        for (const [key, response] of Object.entries(responses)) {
            if (key !== 'default' && lowerMessage.includes(key)) {
                return response;
            }
        }
        
        return responses.default;
    }
});
</script>