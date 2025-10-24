
    <style>
        /* Base Styles */
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #f9fafb;
            --accent-color: #10b981;
            --text-color: #111827;
            --light-text: #6b7280;
            --chat-bg: #ffffff;
            --user-bubble: #e0e7ff;
            --bot-bubble: #f3f4f6;
            --product-bg: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Chatbot Container */
        #chatbot-container {
            position: fixed;
            bottom: 100px;
            right: 20px;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        /* Chatbot Icon */
        #chatbot-icon {
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        #chatbot-icon:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        #chatbot-icon svg {
            width: 30px;
            height: 30px;
            fill: white;
        }

        /* Chat Window */
        #chat-window {
            width: 350px;
            height: 500px;
            background-color: var(--chat-bg);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            display: none;
            flex-direction: column;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        #chat-window.active {
            display: flex;
            transform: translateY(0);
            opacity: 1;
        }

        /* Chat Header */
        .chat-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-header h3 {
            font-weight: 600;
            font-size: 16px;
        }

        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }

        /* Chat Messages */
        .chat-messages {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background-color: var(--secondary-color);
            position: relative;
        }

        .message {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .message-user {
            align-items: flex-end;
        }

        .message-bot {
            align-items: flex-start;
        }

        .message-content {
            max-width: 80%;
            padding: 10px 15px;
            border-radius: 18px;
            margin-top: 5px;
            font-size: 14px;
            line-height: 1.4;
            position: relative;
            animation: fadeIn 0.3s ease;
        }

        .user-message {
            background-color: var(--user-bubble);
            color: var(--text-color);
            border-bottom-right-radius: 4px;
        }

        .bot-message {
            background-color: var(--bot-bubble);
            color: var(--text-color);
            border-bottom-left-radius: 4px;
        }

        .typing-indicator {
            display: inline-block;
        }

        .typing-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--light-text);
            margin-right: 4px;
            animation: typingAnimation 1.4s infinite ease-in-out;
        }

        .typing-dot:nth-child(1) {
            animation-delay: 0s;
        }

        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
            margin-right: 0;
        }

        /* Product Cards */
        .product-card {
            background-color: var(--product-bg);
            border-radius: 8px;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #e2e8f0;
        }

        .product-card h4 {
            color: var(--primary-color);
            margin-bottom: 5px;
            font-size: 14px;
        }

        .product-card p {
            font-size: 12px;
            color: var(--light-text);
            margin-bottom: 5px;
        }

        .product-price {
            font-weight: bold;
            color: var(--text-color);
        }

        .original-price {
            text-decoration: line-through;
            color: var(--light-text);
            margin-right: 5px;
        }

        .product-link {
            display: inline-block;
            margin-top: 5px;
            font-size: 12px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .product-link:hover {
            text-decoration: underline;
        }

        /* Chat Input */
        .chat-input {
            padding: 15px;
            background-color: white;
            border-top: 1px solid #e5e7eb;
            display: flex;
        }

        #user-input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #e5e7eb;
            border-radius: 24px;
            outline: none;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        #user-input:focus {
            border-color: var(--primary-color);
        }

        #send-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-left: 10px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s;
        }

        #send-btn:hover {
            background-color: #4338ca;
        }

        #send-btn svg {
            width: 18px;
            height: 18px;
            fill: white;
        }

        /* Quick Reply Buttons */
        .quick-replies {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .quick-reply-btn {
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 6px 12px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .quick-reply-btn:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Links in messages */
        .chat-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            margin-top: 8px;
        }

        .chat-link:hover {
            text-decoration: underline;
        }

        /* FAQ Accordion */
        .faq-accordion {
            margin-top: 10px;
        }

        .faq-item {
            border-bottom: 1px solid #e5e7eb;
            padding: 10px 0;
        }

        .faq-question {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            padding: 8px 0;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-color);
        }

        .faq-question:hover {
            color: var(--primary-color);
        }

        .faq-icon {
            font-size: 16px;
            margin-left: 10px;
        }

        .faq-answer {
            padding: 8px 0;
            display: none;
            font-size: 13px;
            line-height: 1.5;
            color: var(--light-text);
        }

        .faq-item.open .faq-answer {
            display: block;
        }

        .faq-link {
            display: inline-block;
            margin-top: 8px;
            color: var(--primary-color);
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
        }

        .faq-link:hover {
            text-decoration: underline;
        }

        /* Scroll Down Button */
        .scroll-down-btn {
            position: absolute;
            right: 20px;
            bottom: 70px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .scroll-down-btn.visible {
            opacity: 1;
        }

        .scroll-down-btn:hover {
            background-color: #4338ca;
        }

        /* Animations */
        @keyframes typingAnimation {

            0%,
            60%,
            100% {
                transform: translateY(0);
            }

            30% {
                transform: translateY(-5px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes typewriter {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            #chatbot-container {
                bottom: 140px;
                right: 15px;
            }
            #chat-window {
                width: 100%;
                height: 100%;
                border-radius: 0;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Chatbot Container -->
    <div id="chatbot-container">
        <div id="chat-window">
            <div class="chat-header">
                <h3>E-commerce Assistant</h3>
                <button class="close-btn">&times;</button>
            </div>
            <div class="chat-messages" id="chat-messages">
                <!-- Messages will appear here -->
            </div>
            <button class="scroll-down-btn" id="scroll-down-btn">↓</button>
            <div class="chat-input">
                <input type="text" id="user-input" placeholder="Type your message..." autocomplete="off">
                <button id="send-btn">
                    <svg viewBox="0 0 24 24">
                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div id="chatbot-icon">
            <svg viewBox="0 0 24 24">
                <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"></path>
            </svg>
        </div>
    </div>

    <script>
        // Product Database (from your JSON)
        let productDatabase = {}

        const getPrducts = async ()=>{
            let products = await fetch('/HawaanEcommerce/data/products.json')
            productDatabase = await products.json()
            console.log(products, productDatabase)

        }

        // Chatbot Configuration
        const chatbotConfig = {
            responses: {
                greeting: [
                    "Hello! 👋 I'm your e-commerce assistant. How can I help you today?",
                    "Hi there! 😊 I'm here to assist you with any questions about our store.",
                    "Welcome! 🎉 How may I assist you with your shopping today?"
                ],
                introduction: {
                    text: "We are a premier e-commerce platform offering high-quality products across various categories. Our mission is to provide exceptional value and customer service.",
                    link: "HawaanEcommerce/other pages/about.php",
                    linkText: "Learn more about us"
                },
                returnPolicy: {
                    text: "We offer a 30-day return policy for most items. Items must be unused with original packaging. For electronics, we provide a 14-day return window.",
                    link: "HawaanEcommerce/other pages/Returnpolicy.php",
                    linkText: "View full return policy"
                },
                privacyPolicy: {
                    text: "Your privacy is important to us. We collect only necessary data to process orders and improve your shopping experience. We never sell your information to third parties.",
                    link: "HawaanEcommerce/other pages/privacypolicy.php",
                    linkText: "Read privacy policy"
                },
                aboutUs: {
                    text: "Founded in 2020, HAWAAN began as a vision to revolutionize online fashion shopping by bringing together quality, style, and affordability under one roof. What started as a small team's dream has grown into a trusted destination for millions of fashion-forward customers worldwide Our name represents the winds of change in e-commerce - bringing fresh perspectives, innovative designs, and exceptional shopping experiences to the digital marketplace. Today, we curate the finest collections from emerging designers and established brands, offering something special for every style and occasion",
                    link: "HawaanEcommerce/other pages/about.php",
                    linkText: "View About Page"
                },
                contactSupport: {
                    text: "You can reach our support team via:\n- Email: support@example.com\n- Phone: +1 (555) 123-4567\n- Live chat: Available 9AM-9PM EST",
                    link: "HawaanEcommerce/other pages/contact.php",
                    linkText: "Contact form"
                },
                blogArticles: {
                    text: "We regularly publish helpful articles on shopping tips, product guides, and industry trends.",
                    link: "HawaanEcommerce/other pages/blogs.php",
                    linkText: "Browse our blog"
                },
                faqs: {

                    sections: [
                        {
                            question: "How long does delivery take?",
                            answer: "Standard delivery times:\n- Karachi: 1-2 working days\n- Lahore/Islamabad: 2-3 working days\n- Other cities: 3-5 working days\n\nExpress delivery available at checkout.",
                        },
                        {
                            question: "What payment methods do you accept?",
                            answer: "We accept:\n- Credit/Debit Cards (Visa, MasterCard)\n- EasyPaisa/JazzCash\n- Bank Transfers\n- Cash on Delivery\n- Installment plans via credit cards",
 
                        },
                        {
                            question: "How do I track my order?",
                            answer: "Track your order:\n1. Go to 'My Orders'\n2. Click 'Track Package'\n3. Get real-time updates\n\nYou'll also receive SMS/email notifications at each stage.",
  
                        },
                        {
                            question: "Do you offer international shipping?",
                            answer: "Currently we only ship within Pakistan. We're working to expand to:\n- UAE\n- USA\n- UK\n- Canada\n\nSign up for updates on international shipping.",
         
                        },
                        {
                            question: "What if I receive a damaged product?",
                            answer: "If you receive a damaged item:\n1. Don't accept delivery or take photos if already opened\n2. Contact us within 24 hours\n3. We'll arrange replacement immediately\n\nNo questions asked replacement policy for damaged items.",
        
                        }
                    ]
                },
                unknown: [
                    "I'm not sure I understand. Could you rephrase your question?",
                    "I don't have information on that. Please contact our support team for assistance.",
                    "That's beyond my current knowledge. Try asking about our products, policies, or services."
                ],
                productGuide: {
                                        link: "HawaanEcommerce/other pages/sizeguide.php",

                    default: "I can help you find products. Please tell me:\n- What category you're interested in (e.g., electronics, clothing)\n- Your budget range\n- Any specific features you need",
                    categories: {
                        electronics: "We have a wide range of electronics including smartphones, laptops, and accessories.",
                        clothing: "Our clothing collection features the latest fashion trends for men, women, and kids.",
                        home: "Discover home essentials from kitchenware to furniture and decor items.",

                    },
                    budget: {
                        low: "Here are affordable options under $50:",
                        medium: "Here are quality products between $50-$200:",
                        high: "Here are premium products over $200:"
                    }
                }
            },
            
            // Category mappings for better recognition
            categoryKeywords: {
                "mens-collection": ["men", "man", "gentleman", "male", "mens", "mans"],
                "mens-accessories": ["men-accesssories", "mens-accesssories", "accesssories for men", "male-accesssories", "accesssories"],
                "womens-collection": ["women", "woman", "lady", "female", "womens", "ladies"],
                "kids-collection": ["kids", "kid", "children", "child", "boys", "girls"],
                "makeup": ["makeup", "cosmetic", "beauty"],
                "perfumes": ["perfume", "fragrance", "scent"],
                "jewellery": ["jewelry", "jewellery", "ring", "necklace", "earring"],
                "electronics": ["electronic", "tech", "gadget", "device"]
            },

            // Subcategory mappings
            subcategoryKeywords: {
                "formal": ["formal", "office", "business", "suit", "dress"],
                "casual": ["casual", "everyday", "regular"],
                "tshirts": ["tshirt", "t-shirt", "tee"],
                "jackets": ["jacket", "coat", "blazer"],
                "shorts": ["shorts", "short pants"],
                "kurtas": ["kurta", "traditional", "ethnic"],
                "saree": ["saree", "sari"],
                "lehenga": ["lehenga", "choli"],
                "dupattas": ["dupatta", "shawl", "scarf"],
                "trousers": ["trouser", "pants", "slacks"],
                "lipstick": ["lipstick", "lip color"],
                "eyeliner": ["eyeliner", "eye liner"],
                "primer": ["primer", "base"],
                "mascara": ["mascara", "lash"],
                "floral": ["floral", "flower"],
                "oriental": ["oriental", "spice", "spicy"],
                "woody": ["woody", "wood", "sandalwood"],
                "fougere": ["fougere", "fresh"],
                "earrings": ["earring", "ear ring"],
                "couplerings": ["couple ring", "wedding ring", "marriage ring"],
                "necklace": ["necklace", "chain"],
                "bracelet": ["bracelet", "bangle"],
                "sunglasses": ["sunglass", "sun glass"],
                "watches": ["watch", "timepiece"],
                "wallets": ["wallet", "money"],
                "shoes": ["shoe", "footwear"],
                "sw": ["smart watch", "smartwatch"],
                "stv": ["smart tv", "television", "tv"],
                "mouse": ["mouse", "computer mouse"],
                "microphone": ["microphone", "mic"]
            },

            // Quick reply suggestions
            quickReplies: [
                "Return policy",
                "Contact support",
                "Find men's formal shoes",
                "Find dresses under $100 for ladies",
                "About us",
                "What's your privacy policy?",
                "Privacy policy",
                "men-accessories"
            ]
        };

        // DOM Elements
        const chatbotIcon = document.getElementById('chatbot-icon');
        const chatWindow = document.getElementById('chat-window');
        const chatMessages = document.getElementById('chat-messages');
        const userInput = document.getElementById('user-input');
        const sendBtn = document.getElementById('send-btn');
        const closeBtn = document.querySelector('.close-btn');
        const scrollDownBtn = document.getElementById('scroll-down-btn');

        // State
        let activeFaqIndex = null;

        // Toggle chat window visibility
        chatbotIcon.addEventListener('click', () => {
            chatWindow.classList.toggle('active');
            if (chatWindow.classList.contains('active')) {
                getPrducts()
                // Add welcome message if chat is empty
                if (chatMessages.children.length === 0) {
                    addBotMessage(getRandomResponse(chatbotConfig.responses.greeting));
                }
            }
        });

        closeBtn.addEventListener('click', () => {
            chatWindow.classList.remove('active');
        });

        // Handle user input
        function handleUserInput() {
            const message = userInput.value.trim();
            if (message) {
                addUserMessage(message);
                userInput.value = '';
                processUserMessage(message);
            }
        }

        // Send message on button click or Enter key
        sendBtn.addEventListener('click', handleUserInput);
        userInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                handleUserInput();
            }
        });

        // Add user message to chat
        function addUserMessage(text) {
            const messageDiv = document.createElement('div');
            messageDiv.className = 'message message-user';
            messageDiv.innerHTML = `
                <div class="message-content user-message">${text}</div>
                <span class="message-timestamp">${getCurrentTime()}</span>
            `;
            chatMessages.appendChild(messageDiv);
            scrollToBottom();
        }

        // Add bot message to chat with typing animation
        function addBotMessage(text, link = null, linkText = null, products = null) {
            // Show typing indicator
            const typingDiv = document.createElement('div');
            typingDiv.className = 'message message-bot';
            typingDiv.innerHTML = `
                <div class="message-content bot-message typing-indicator">
                    <span class="typing-dot"></span>
                    <span class="typing-dot"></span>
                    <span class="typing-dot"></span>
                </div>
            `;
            chatMessages.appendChild(typingDiv);
            scrollToBottom();

            // Replace typing indicator with actual message after delay
            setTimeout(() => {
                typingDiv.innerHTML = `
                    <div class="message-content bot-message">${text}
                        ${link ? `<a href="/${link}" class="chat-link" target="_blank">${linkText || 'Learn more'}</a>` : ''}
                        ${products ? formatProducts(products) : ''}
                    </div>
                    <span class="message-timestamp">${getCurrentTime()}</span>
                `;
                scrollToBottom();
                
                // Add quick reply buttons if not a product response
                if (!products && !text.includes("frequently asked")) {
                    addQuickReplies();
                }
            }, 1500);
        }

        // Format product cards for display
        function formatProducts(products) {
            let html = '<div class="products-container">';
            products.forEach(product => {
                const discount = product.originalPrice ? 
                    Math.round(100 - (product.price / product.originalPrice * 100)) : 0;
                
                html += `
                    <div class="product-card">
                        <h4>${product.name}</h4>
                        <p>${product.description}</p>
                        <p>Brand: ${product.brand}</p>
                        <p class="product-price">
                            ${product.originalPrice ? `<span class="original-price">$${product.originalPrice.toFixed(2)}</span>` : ''}
                            $${product.price.toFixed(2)}
                            ${discount > 0 ? `<span style="color:var(--accent-color);">(${discount}% off)</span>` : ''}
                        </p>
                        <a href="${product.link || '#'}" class="product-link">View Product</a>
                    </div>
                `;
            });
            html += '</div>';
            return html;
        }

        // Add quick reply buttons
        function addQuickReplies() {
            const quickRepliesDiv = document.createElement('div');
            quickRepliesDiv.className = 'quick-replies';
            
            // Get 3 random quick replies
            const shuffled = [...chatbotConfig.quickReplies].sort(() => 0.5 - Math.random());
            const selectedReplies = shuffled.slice(0, 3);
            
            selectedReplies.forEach(reply => {
                const button = document.createElement('button');
                button.className = 'quick-reply-btn';
                button.textContent = reply;
                button.addEventListener('click', () => {
                    addUserMessage(reply);
                    processUserMessage(reply);
                });
                quickRepliesDiv.appendChild(button);
            });
            
            const messageDiv = document.createElement('div');
            messageDiv.className = 'message message-bot';
            messageDiv.appendChild(quickRepliesDiv);
            chatMessages.appendChild(messageDiv);
            scrollToBottom();
        }

        // Show FAQ response with accordion
        function showFaqResponse() {
            const messageDiv = document.createElement('div');
            messageDiv.className = 'message message-bot';
            messageDiv.innerHTML = `
                <div class="message-content bot-message">
                    Here are answers to frequently asked questions:
                    <div class="faq-accordion" id="faq-accordion"></div>
                </div>
                <span class="message-timestamp">${getCurrentTime()}</span>
            `;
            
            const faqAccordion = messageDiv.querySelector('#faq-accordion');
            chatbotConfig.responses.faqs.sections.forEach((faq, index) => {
                const faqItem = document.createElement('div');
                faqItem.className = 'faq-item';
                faqItem.innerHTML = `
                    <button class="faq-question">
                        ${faq.question}
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>${faq.answer.replace(/\n/g, '<br>')}</p>
                        ${faq.link ? `<a href="${faq.link}" class="faq-link" target="_blank">${faq.linkText}</a>` : ''}
                    </div>
                `;
                
                const questionBtn = faqItem.querySelector('.faq-question');
                questionBtn.addEventListener('click', () => {
                    faqItem.classList.toggle('open');
                    const icon = faqItem.querySelector('.faq-icon');
                    icon.textContent = faqItem.classList.contains('open') ? '−' : '+';
                });
                
                faqAccordion.appendChild(faqItem);
            });
            
            chatMessages.appendChild(messageDiv);
            scrollToBottom();
            
            // Add quick replies after FAQ
            addQuickReplies();
        }

        // Process user message and generate response
        function processUserMessage(message) {
            const lowerMsg = message.toLowerCase();
            // Check for greeting
if (/hi|hello|hey|yo|good morning|good evening|good afternoon|howdy|greetings|what's up|wassup|sup|hi there|hey there|yo buddy|hola|heya|hi bot|hello bot|hello there|hey friend/.test(lowerMsg)) {
    addBotMessage(getRandomResponse(chatbotConfig.responses.greeting));
    return;
}

// Check for introduction
if (/who are you|what are you|tell me about yourself|introduce yourself|what is your name|who made you|what can you do|your purpose|what are you capable of|your introduction|describe yourself|who built you|what is your role|are you real|are you a human|who created you|are you ai|what do you do|tell me about your skills|your job|your work/.test(lowerMsg)) {
    const response = chatbotConfig.responses.introduction;
    addBotMessage(response.text, response.link, response.linkText);
    return;
}

// Check for return/refund/exchange
if (/return|refund|exchange|cancel my order|order return|how to return|product return|get my money back|money refund|refund status|return request|order cancellation|refund process|exchange item|replacement|defective product|wrong item delivered|incorrect order|refund policy|return my product|refund my money/.test(lowerMsg)) {
    const response = chatbotConfig.responses.returnPolicy;
    addBotMessage(response.text, response.link, response.linkText);
    return;
}

// Check for privacy/data
if (/privacy|data|gdpr|personal data|security|data safety|information security|your privacy policy|data collection|how you use my data|is my data safe|customer privacy|protect data|information protection|user data|data usage|data rights|confidentiality|private information|delete my data|do you share data/.test(lowerMsg)) {
    const response = chatbotConfig.responses.privacyPolicy;
    addBotMessage(response.text, response.link, response.linkText);
    return;
}

// Check for about company
if (/about you|about your company|tell me about your company|company info|who runs this|who owns this|business details|more about you|what is this company|company introduction|about brand|about team|company history|company background|when was this company started|who founded this|tell me about your work|what does this company do|company profile|about your business/.test(lowerMsg)) {
    const response = chatbotConfig.responses.aboutUs;
    addBotMessage(response.text, response.link, response.linkText);
    return;
}

// Check for contact/support/help
if (/contact|support|help|customer service|contact details|how can i contact you|support team|talk to human|get in touch|email support|phone number|contact info|need help|customer care|reach you|connect with support|chat with agent|speak to representative|contact us|support desk|i need help|assist me/.test(lowerMsg)) {
    const response = chatbotConfig.responses.contactSupport;
    addBotMessage(response.text, response.link, response.linkText);
    return;
}

// Check for blog/articles
if (/blog|article|post|writeups|latest posts|read blog|show articles|news section|company blog|recent post|new articles|read more|blog updates|any article|company news|blog link|recent blogs|latest articles|writeup section|read section/.test(lowerMsg)) {
    const response = chatbotConfig.responses.blogArticles;
    addBotMessage(response.text, response.link, response.linkText);
    return;
}

// Check for FAQ
if (/faq|frequently asked|common questions|question list|faqs|help topics|common issues|help questions/.test(lowerMsg)) {
    showFaqResponse();
    return;
}

            
            // Product search queries
            if (/find|search|look for|show me|product|buy|shop|want|need|looking|give me|display|list/i.test(lowerMsg)) {
                const products = searchProducts(message);
                
                if (products.length > 0) {
                    let responseText = `I found ${products.length} matching products:`;
                    
                    // Add context about what was searched
                    const mainCategory = Object.entries(chatbotConfig.categoryKeywords).find(
                        ([_, keywords]) => keywords.some(kw => lowerMsg.includes(kw)))
                    ?.[0];
                    
                    const subcategory = Object.entries(chatbotConfig.subcategoryKeywords).find(
                        ([_, keywords]) => keywords.some(kw => lowerMsg.includes(kw)))
                    ?.[0];
                    
                    if (mainCategory) {
                        const prettyCategory = mainCategory.replace('-collection', '').replace(/-/g, ' ');
                        responseText += ` in ${prettyCategory} collection`;
                        
                        if (subcategory) {
                            responseText += ` (${subcategory} category)`;
                        }
                    }
                    
                    const priceMatch = message.match(/\$?(\d+)/);
                    if (priceMatch) {
                        const price = parseFloat(priceMatch[1]);
                        if (/under|below|less/i.test(lowerMsg)) {
                            responseText += ` under $${price}`;
                        } else if (/over|above|more/i.test(lowerMsg)) {
                            responseText += ` over $${price}`;
                        } else {
                            responseText += ` around $${price}`;
                        }
                    }
                    
                    addBotMessage(responseText, null, null, products);
                } else {
                    let notFoundMessage = "I couldn't find any products matching your request.";
                    
                    // Give specific feedback about what wasn't found
                    const mainCategory = Object.entries(chatbotConfig.categoryKeywords).find(
                        ([_, keywords]) => keywords.some(kw => lowerMsg.includes(kw)))
                    ?.[0];
                    
                    const subcategory = Object.entries(chatbotConfig.subcategoryKeywords).find(
                        ([_, keywords]) => keywords.some(kw => lowerMsg.includes(kw)))
                    ?.[0];
                    
                    if (mainCategory) {
                        const prettyCategory = mainCategory.replace('-collection', '').replace(/-/g, ' ');
                        notFoundMessage += ` We currently don't have products in our ${prettyCategory} collection`;
                        
                        if (subcategory) {
                            notFoundMessage += ` (${subcategory} category)`;
                        }
                        
                        notFoundMessage += " or they may be out of stock.";
                    }
                    
                    addBotMessage(notFoundMessage);
                }
                return;
            }
            
            // Budget queries
            if (/\$|dollar|price|cost|budget|cheap|expensive|affordable/.test(lowerMsg)) {
                handleBudgetQuery(message);
                return;
            }
            
            // If no matches found
            addBotMessage(getRandomResponse(chatbotConfig.responses.unknown));
        }

        // Search products based on query
        function searchProducts(query) {
            const lowerQuery = query.toLowerCase();
            let foundProducts = [];
            
            // 1. Determine main category
            let mainCategory = null;
            for (const [category, keywords] of Object.entries(chatbotConfig.categoryKeywords)) {
                if (keywords.some(keyword => lowerQuery.includes(keyword))) {
                    mainCategory = category;
                    break;
                }
            }
            
            // 2. Determine subcategory
            let subcategory = null;
            for (const [subcat, keywords] of Object.entries(chatbotConfig.subcategoryKeywords)) {
                if (keywords.some(keyword => lowerQuery.includes(keyword))) {
                    subcategory = subcat;
                    break;
                }
            }
            
            // 3. Extract price range
            const priceMatch = lowerQuery.match(/\$?(\d+)/);
            const price = priceMatch ? parseFloat(priceMatch[1]) : null;
            const underPrice = /under \$?\d+|less than \$?\d+|below \$?\d+|upto \$?\d+|maximum \$?\d+/i.test(lowerQuery);
            const overPrice = /over \$?\d+|more than \$?\d+|above \$?\d+|minimum \$?\d+/i.test(lowerQuery);
            const exactPrice = /for \$?\d+|around \$?\d+|near \$?\d+/i.test(lowerQuery);
            
            // 4. Search logic
            if (mainCategory) {
                // Search in specific main category
                const categoryProducts = productDatabase[mainCategory];
                
                if (subcategory) {
                    // Search in specific subcategory
                    if (categoryProducts && categoryProducts[subcategory]) {
                        foundProducts = filterByPrice(categoryProducts[subcategory], price, underPrice, overPrice, exactPrice);
                    }
                } else {
                    // Search all subcategories in main category
                    if (categoryProducts) {
                        for (const subcatProducts of Object.values(categoryProducts)) {
                            foundProducts = foundProducts.concat(
                                filterByPrice(subcatProducts, price, underPrice, overPrice, exactPrice)
                            );
                        }
                    }
                }
            } else if (subcategory) {
                // Search subcategory across all main categories
                for (const categoryProducts of Object.values(productDatabase)) {
                    if (categoryProducts[subcategory]) {
                        foundProducts = foundProducts.concat(
                            filterByPrice(categoryProducts[subcategory], price, underPrice, overPrice, exactPrice)
                        );
                    }
                }
            } else if (price) {
                // Search all products by price only
                for (const categoryProducts of Object.values(productDatabase)) {
                    for (const subcatProducts of Object.values(categoryProducts)) {
                        foundProducts = foundProducts.concat(
                            filterByPrice(subcatProducts, price, underPrice, overPrice, exactPrice)
                        );
                    }
                }
            } else {
                // No specific filters - search all products for keywords
                for (const categoryProducts of Object.values(productDatabase)) {
                    for (const subcatProducts of Object.values(categoryProducts)) {
                        foundProducts = foundProducts.concat(
                            filterByKeywords(subcatProducts, lowerQuery)
                        );
                    }
                }
            }
            
            // Remove duplicates and limit results
            return [...new Set(foundProducts)].slice(0, 5);
        }

        // Helper function to filter by price
        function filterByPrice(products, price, underPrice, overPrice, exactPrice) {
            if (!price) return products;
            
            return products.filter(product => {
                if (exactPrice) {
                    // ±20% range for "around $X" queries
                    return product.price >= price * 0.8 && product.price <= price * 1.2;
                } else if (underPrice) {
                    return product.price <= price;
                } else if (overPrice) {
                    return product.price >= price;
                } else {
                    // Default to "under X" if no modifier specified
                    return product.price <= price;
                }
            });
        }

        // Helper function to filter by keywords
        function filterByKeywords(products, query) {
            const searchTerms = query.split(/\s+/);
            return products.filter(product => {
                const productText = `${product.name} ${product.description} ${product.brand}`.toLowerCase();
                return searchTerms.every(term => productText.includes(term));
            });
        }

        // Handle budget-related queries
        function handleBudgetQuery(message) {
            const priceMatch = message.match(/\$?(\d+)/);
            if (priceMatch) {
                const price = parseInt(priceMatch[1]);
                let budgetRange = '';
                
                if (price < 50) {
                    budgetRange = 'low';
                } else if (price <= 200) {
                    budgetRange = 'medium';
                } else {
                    budgetRange = 'high';
                }
                
                // Find products in the budget range
                const products = [];
                for (const [coll, categories] of Object.entries(productDatabase)) {
                    for (const [cat, items] of Object.entries(categories)) {
                        for (const product of items) {
                            if (
                                (budgetRange === 'low' && product.price < 50) ||
                                (budgetRange === 'medium' && product.price >= 50 && product.price <= 200) ||
                                (budgetRange === 'high' && product.price > 200)
                            ) {
                                products.push(product);
                            }
                        }
                    }
                }
                
                // Show up to 3 random products in the budget range
                const shuffled = [...products].sort(() => 0.5 - Math.random());
                const selectedProducts = shuffled.slice(0, 3);
                
                if (selectedProducts.length > 0) {
                    addBotMessage(
                        chatbotConfig.responses.productGuide.budget[budgetRange],
                        null,
                        null,
                        selectedProducts
                    );
                } else {
                    addBotMessage(
                        `We couldn't find products in that price range. Try adjusting your budget or browse our full catalog.`,
                        '/products',
                        'View all products'
                    );
                }
            } else {
                addBotMessage("Please specify a budget amount (e.g., 'under $100') so I can recommend suitable products.");
            }
        }

        // Helper function to get random response from array
        function getRandomResponse(responses) {
            return responses[Math.floor(Math.random() * responses.length)];
        }

        // Scroll chat to bottom
        function scrollToBottom() {
            chatMessages.scrollTop = chatMessages.scrollHeight;
            scrollDownBtn.classList.remove('visible');
        }

        // Show/hide scroll down button based on scroll position
        chatMessages.addEventListener('scroll', function() {
            const { scrollTop, scrollHeight, clientHeight } = chatMessages;
            const isNearBottom = scrollHeight - (scrollTop + clientHeight) < 50;
            
            if (isNearBottom) {
                scrollDownBtn.classList.remove('visible');
            } else {
                scrollDownBtn.classList.add('visible');
            }
        });

        // Scroll to bottom when button is clicked
        scrollDownBtn.addEventListener('click', scrollToBottom);

        // Get current time in HH:MM format
        function getCurrentTime() {
            const now = new Date();
            return now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }

        // Initialize chatbot with welcome message when opened
        chatWindow.addEventListener('click', function initChatbot() {
            if (chatMessages.children.length === 0) {
                addBotMessage(getRandomResponse(chatbotConfig.responses.greeting));
            }
            chatWindow.removeEventListener('click', initChatbot);
        });
    </script>
</body>
</html>