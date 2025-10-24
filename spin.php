<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spin Wheel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Floating Spin Icon */
        .spin-icon {
            position: fixed;
            right: 20px;
            bottom: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ff5722 0%, #ff8a65 100%);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 32px;
            color: #fff;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(255, 87, 34, 0.4);
            z-index: 1000;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }

        .spin-icon:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(255, 87, 34, 0.6);
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Modal Styles */
        .spin-wheel-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
        }

        /* Blurred Overlay */
        .spin-wheel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(8px);
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        /* Modal Content */
        .spin-wheel-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            background: linear-gradient(135deg, #ffffff 0%, #f5f7fa 100%);
            border-radius: 20px;
            padding: 30px;
            width: 90%;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: all 0.3s ease;
        }

        /* Header */
        .spin-wheel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .spin-wheel-header h3 {
            font-size: 24px;
            color: #333;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .close-btn {
            background: #f5f5f5;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 22px;
            cursor: pointer;
            color: #777;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .close-btn:hover {
            background: #ff5722;
            color: white;
            transform: rotate(90deg);
        }

        /* Canvas & Spin Button */
        .wheel-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        #wheelCanvas {
            display: block;
            margin: 0 auto;
            width: 100%;
            height: auto;
            max-width: 500px;
            max-height: 500px;
            border-radius: 50%;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .pointer {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 40px solid #ff5722;
            z-index: 5;
            filter: drop-shadow(0 3px 5px rgba(0, 0, 0, 0.2));
        }

        .spin-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(135deg, #ff5722 0%, #ff8a65 100%);
            color: white;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
            font-size: 20px;
            z-index: 10;
            box-shadow: 0 5px 15px rgba(255, 87, 34, 0.4);
            transition: all 0.3s ease;
            border: 4px solid white;
        }

        .spin-button:hover {
            transform: translate(-50%, -50%) scale(1.05);
            box-shadow: 0 8px 20px rgba(255, 87, 34, 0.6);
        }

        .spin-button.spinning {
            pointer-events: none;
            opacity: 0.8;
            transform: translate(-50%, -50%) scale(0.95);
        }

        /* Spin Result */
        .spin-result {
            margin-top: 30px;
            padding: 20px;
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            border-radius: 12px;
            display: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #4caf50;
            text-align: center;
        }

        .spin-result h4 {
            color: #2e7d32;
            margin-bottom: 10px;
            font-size: 22px;
        }

        .spin-result p {
            margin: 8px 0;
            color: #333;
            font-size: 16px;
        }

        .spin-result strong {
            color: #ff5722;
        }

        /* Error Message */
        .error-message {
            margin-top: 20px;
            padding: 15px;
            background: #ffebee;
            border-radius: 8px;
            color: #c62828;
            display: none;
            border-left: 5px solid #c62828;
        }

        /* Loading Spinner */
        .loading {
            display: inline-block;
            width: 30px;
            height: 30px;
            border: 4px solid rgba(255, 87, 34, 0.3);
            border-radius: 50%;
            border-top-color: #ff5722;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Confetti effect */
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f0f;
            opacity: 0.7;
            border-radius: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .spin-wheel-content {
                padding: 20px;
                width: 95%;
                max-width: 500px;
            }
            
            .spin-wheel-header h3 {
                font-size: 20px;
            }
            
            .wheel-container {
                padding: 10px;
                max-width: 400px;
            }
            
            #wheelCanvas {
                max-width: 400px;
                max-height: 400px;
            }
            
            .spin-button {
                width: 80px;
                height: 80px;
                font-size: 18px;
            }
            
            .pointer {
                border-left: 15px solid transparent;
                border-right: 15px solid transparent;
                border-top: 30px solid #ff5722;
            }
        }

        @media (max-width: 480px) {
            .spin-icon {
                width: 60px;
                height: 60px;
                font-size: 26px;
                bottom: 70px;
                right: 15px;
            }
            
            .spin-wheel-content {
                max-width: 350px;
            }
            
            .wheel-container {
                max-width: 300px;
            }
            
            #wheelCanvas {
                max-width: 300px;
                max-height: 300px;
            }
            
            .spin-button {
                width: 70px;
                height: 70px;
                font-size: 16px;
            }
            
            .spin-result {
                padding: 15px;
            }
            
            .spin-result h4 {
                font-size: 18px;
            }
            
            .spin-result p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Spin Wheel Floating Modal -->
    <div id="spinWheelModal" class="spin-wheel-modal">
        <div class="spin-wheel-overlay" id="spinOverlay"></div>

        <div class="spin-wheel-content">
            <div class="spin-wheel-header">
                <h3><i class="fas fa-gift"></i> Daily Spin Wheel</h3>
                <button id="closeSpinModal" class="close-btn">&times;</button>
            </div>
            
            <div class="wheel-container">
                <canvas id="wheelCanvas" width="500" height="500"></canvas>
                <div class="pointer"></div>
                <div class="spin-button" id="spinButton">SPIN</div>
            </div>
            
            <div id="errorMessage" class="error-message"></div>
            <div id="spinResult" class="spin-result"></div>
        </div>
    </div>

    <!-- Floating Spin Icon -->
    <div id="spinIcon" class="spin-icon">
        <i class="fas fa-gift"></i>
    </div>

    <script>
        // Modal Open/Close with animations
        const spinIcon = document.getElementById('spinIcon');
        const spinModal = document.getElementById('spinWheelModal');
        const closeModal = document.getElementById('closeSpinModal');
        const spinOverlay = document.getElementById('spinOverlay');
        const spinContent = document.querySelector('.spin-wheel-content');
        const errorMessage = document.getElementById('errorMessage');

        spinIcon.addEventListener('click', () => {
            spinModal.style.display = 'block';
            setTimeout(() => {
                spinOverlay.style.opacity = '1';
                spinContent.style.opacity = '1';
                spinContent.style.transform = 'translate(-50%, -50%) scale(1)';
            }, 10);
        });

        function closeModalFunc() {
            spinOverlay.style.opacity = '0';
            spinContent.style.opacity = '0';
            spinContent.style.transform = 'translate(-50%, -50%) scale(0.9)';
            setTimeout(() => {
                spinModal.style.display = 'none';
            }, 300);
        }

        closeModal.addEventListener('click', closeModalFunc);
        spinOverlay.addEventListener('click', closeModalFunc);

        // Wheel logic with actual backend API calls
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('wheelCanvas');
            const ctx = canvas.getContext('2d');
            const spinButton = document.getElementById('spinButton');
            const resultDiv = document.getElementById('spinResult');

            // Adjust canvas size for high DPI displays
            const dpr = window.devicePixelRatio || 1;
            const size = 500;
            canvas.width = size * dpr;
            canvas.height = size * dpr;
            ctx.scale(dpr, dpr);
            canvas.style.width = `${size}px`;
            canvas.style.height = `${size}px`;

            const colors = ['#FF5252', '#FF4081', '#E040FB', '#7C4DFF', '#536DFE', '#448AFF', '#40C4FF', '#18FFFF', '#64FFDA', '#69F0AE'];
            
            let prizes = [];
            let isDataLoaded = false;

            // Show loading state
            spinButton.innerHTML = '<div class="loading"></div>';
            
            // Fetch prizes from backend API
            fetch('/HawaanEcommerce/get-prizes.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(prizesData => {
                    prizes = prizesData;
                    isDataLoaded = true;
                    spinButton.textContent = 'SPIN';
                    drawWheel(prizes);
                })
                .catch(error => {
                    console.error('Error fetching prizes:', error);
                    spinButton.textContent = 'SPIN';
                    showError('Failed to load prizes. Please try again later.');
                });

            spinButton.addEventListener('click', function() {
                if (!isDataLoaded) {
                    showError('Prizes are still loading. Please wait.');
                    return;
                }
                
                if (this.classList.contains('spinning')) return;

                this.classList.add('spinning');
                resultDiv.style.display = 'none';
                errorMessage.style.display = 'none';

                fetch('/HawaanEcommerce/spin-wheel.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    credentials: 'include' // Include cookies for session
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        showError(data.error);
                        spinButton.classList.remove('spinning');
                        return;
                    }

                    const spinDuration = 3000;
                    const startTime = Date.now();
                    const rotations = 5;

                    function animate() {
                        const elapsed = Date.now() - startTime;
                        const progress = Math.min(elapsed / spinDuration, 1);
                        const easeOut = 1 - Math.pow(1 - progress, 3);
                        const angle = easeOut * rotations * Math.PI * 2;

                        drawWheel(prizes, angle);

                        if (progress < 1) {
                            requestAnimationFrame(animate);
                        } else {
                            spinButton.classList.remove('spinning');
                            showResult(data);
                            createConfetti();
                        }
                    }

                    animate();
                })
                .catch(error => {
                    console.error('Error:', error);
                    showError('An error occurred while spinning. Please try again.');
                    spinButton.classList.remove('spinning');
                });
            });

            function drawWheel(prizes, rotationAngle = 0) {
                const centerX = canvas.width / (2 * dpr);
                const centerY = canvas.height / (2 * dpr);
                const radius = Math.min(centerX, centerY) - 10;

                ctx.clearRect(0, 0, canvas.width, canvas.height);
                const segmentAngle = (2 * Math.PI) / prizes.length;

                // Draw wheel background
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
                ctx.fillStyle = '#f5f5f5';
                ctx.fill();
                ctx.lineWidth = 4;
                ctx.strokeStyle = '#fff';
                ctx.stroke();

                prizes.forEach((prize, index) => {
                    ctx.beginPath();
                    ctx.moveTo(centerX, centerY);
                    ctx.arc(centerX, centerY, radius, rotationAngle + index * segmentAngle, rotationAngle + (index + 1) * segmentAngle, false);
                    ctx.closePath();
                    ctx.fillStyle = colors[index % colors.length];
                    ctx.fill();
                    ctx.stroke();

                    ctx.save();
                    ctx.translate(centerX, centerY);
                    ctx.rotate(rotationAngle + index * segmentAngle + segmentAngle / 2);
                    ctx.textAlign = 'right';
                    ctx.fillStyle = '#fff';
                    ctx.font = `bold ${radius / 12}px Arial`;
                    ctx.shadowColor = 'rgba(0, 0, 0, 0.5)';
                    ctx.shadowBlur = 4;
                    ctx.shadowOffsetX = 2;
                    ctx.shadowOffsetY = 2;
                    ctx.fillText(prize.name, radius - 15, 5);
                    ctx.restore();
                });

                // Draw center circle
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius / 6, 0, 2 * Math.PI);
                ctx.fillStyle = '#fff';
                ctx.fill();
                ctx.strokeStyle = '#e0e0e0';
                ctx.lineWidth = 4;
                ctx.stroke();
            }

            function showResult(data) {
                resultDiv.innerHTML = `
                    <h4>Congratulations!</h4>
                    <p>You won: <strong>${data.prize}</strong></p>
                    <p>Discount: ${data.discount_value}${data.discount_type === 'percentage' ? '%' : '$'} off</p>
                    <p>Coupon Code: <strong>${data.coupon_code}</strong></p>
                    <p>Expires: ${new Date(data.expires_at).toLocaleDateString()}</p>
                    <p><i class="fas fa-check-circle"></i> The coupon has been automatically applied to your account.</p>
                `;
                resultDiv.style.display = 'block';
            }
            
            function showError(message) {
                errorMessage.textContent = message;
                errorMessage.style.display = 'block';
            }

            function createConfetti() {
                for (let i = 0; i < 100; i++) {
                    const confetti = document.createElement('div');
                    confetti.classList.add('confetti');
                    confetti.style.left = Math.random() * 100 + '%';
                    confetti.style.top = -20 + 'px';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
                    confetti.style.width = Math.random() * 10 + 5 + 'px';
                    confetti.style.height = Math.random() * 10 + 5 + 'px';
                    confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
                    document.querySelector('.spin-wheel-content').appendChild(confetti);
                    
                    // Animate confetti
                    const animation = confetti.animate([
                        { top: '-20px', transform: `rotate(0deg)` },
                        { top: Math.random() * 100 + 50 + 'px', transform: `rotate(${Math.random() * 720}deg)` }
                    ], {
                        duration: 1000 + Math.random() * 2000,
                        easing: 'cubic-bezier(0.1, 0.8, 0.3, 1)',
                        fill: 'forwards'
                    });
                    
                    // Remove confetti after animation
                    animation.onfinish = () => {
                        confetti.remove();
                    };
                }
            }

            // Make responsive on window resize
            window.addEventListener('resize', function() {
                const size = Math.min(500, window.innerWidth * 0.8);
                canvas.width = size * dpr;
                canvas.height = size * dpr;
                ctx.scale(dpr, dpr);
                canvas.style.width = `${size}px`;
                canvas.style.height = `${size}px`;
                if (isDataLoaded) {
                    drawWheel(prizes);
                }
            });
        });
    </script>
</body>
</html>