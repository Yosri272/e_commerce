<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>تهانينا على تسجيلك</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 6000px;
            padding: 100px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        h1 {
            color: #333;
        }

        p {
            font-size: 18px;
            color: #666;
        }

        .welcome-message {
            margin: 20px 0;
        }

        h2 {
            color: #333;
        }

        .next-steps {
            margin: 20px 0;
        }

        ul {
            list-style-type: disc;
            margin-left: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* تخصيص زر تسجيل الخروج */
        .logout-button {
            background-color: #d9534f; /* لون خلفية الزر */
            color: #fff; /* لون النص */
            padding: 10px 20px; /* هوامش داخلية للزر */
            border: none; /* إزالة حدود الزر */
            border-radius: 5px; /* تدوير الحواف */
            margin-bottom: 20px; /* Add space at the bottom of the button */
        }

        .logout-button:hover {
            background-color: #c9302c; /* تغيير لون الخلفية عند التحويل */
        }

        .footer {
            text-align: center; /* Center-align the content in the footer */
            margin-top: 20px; /* Add some spacing at the top of the footer */
        }

        .footer a {
            text-decoration: none; /* Remove underlines from links */
            margin: 0 10px; /* Add spacing between links */
        }

        .footer img {
            width: 32px; /* Set the width of the social media icons */
            height: 32px; /* Set the height of the social media icons */
            vertical-align: middle; /* Center the icons vertically with text */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>تهانينا على تسجيلك!</h1>
        <p>لقد تم تسجيلك بنجاح على موقعنا. نتمنى لك تجربة ممتعة.</p>
        
        <div class="welcome-message">
            <h2>مرحبًا بك في مجتمعنا</h2>
           <p>نحن سعداء جدًا بانضمامك إلينا. يمكنك الآن مراجعة الإدارة لاستكمال عملية التسجيل وذلك بالاتصال على الرقم التالي <a href="tel:0502778822">+966 502778822</a> أو زيارة أقرب مركز.</p>
        </div>

        <!-- زر تسجيل الخروج بالاستايل المخصص -->
        <a href="{!! url('/logout') !!}" class="logout-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{__('auth.logout')}}
        </a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        
        <div class="footer">
            <footer id="footer" class="ct-footer" data-id="type-1" itemscope="" itemtype="https://schema.org/WPFooter" >
                <div data-row="bottom" >
                    <div class="ct-container" data-columns-divider="sm" >
                        <div data-column="copyright" ></div>
                        <div data-column="socials" >
                            <div class="ct-footer-socials" data-id="socials" >
                                <div class="ct-social-box" data-icon-size="custom" data-color="custom" data-icons-type="simple" >
                                    <a href="https://wa.me/966502778822" data-network="whatsapp" aria-label="WhatsApp" rel="noopener" >
                                        <span class="ct-icon-container" >
                                            <svg width="20px" height="20px" viewBox="0 0 20 20" aria-hidden="true">
                                                <path d="M10,0C4.5,0,0,4.5,0,10c0,1.9,0.5,3.6,1.4,5.1L0.1,20l5-1.3C6.5,19.5,8.2,20,10,20c5.5,0,10-4.5,10-10S15.5,0,10,0zM6.6,5.3c0.2,0,0.3,0,0.5,0c0.2,0,0.4,0,0.6,0.4c0.2,0.5,0.7,1.7,0.8,1.8c0.1,0.1,0.1,0.3,0,0.4C8.3,8.2,8.3,8.3,8.1,8.5C8,8.6,7.9,8.8,7.8,8.9C7.7,9,7.5,9.1,7.7,9.4c0.1,0.2,0.6,1.1,1.4,1.7c0.9,0.8,1.7,1.1,2,1.2c0.2,0.1,0.4,0.1,0.5-0.1c0.1-0.2,0.6-0.7,0.8-1c0.2-0.2,0.3-0.2,0.6-0.1c0.2,0.1,1.4,0.7,1.7,0.8s0.4,0.2,0.5,0.3c0.1,0.1,0.1,0.6-0.1,1.2c-0.2,0.6-1.2,1.1-1.7,1.2c-0.5,0-0.9,0.2-3-0.6c-2.5-1-4.1-3.6-4.2-3.7c-0.1-0.2-1-1.3-1-2.6c0-1.2,0.6-1.8,0.9-2.1C6.1,5.4,6.4,5.3,6.6,5.3z"/>
                                            </svg>
                                        </span>
                                    </a>
                                    <a href="https://twitter.com/iThamerSA" data-network="twitter" aria-label="X (Twitter)" rel="noopener" >
                                        <span class="ct-icon-container" >
                                            <svg width="20px" height="20px" viewBox="0 0 20 20" aria-hidden="true">
                                                <path d="M2.9 0C1.3 0 0 1.3 0 2.9v14.3C0 18.7 1.3 20 2.9 20h14.3c1.6 0 2.9-1.3 2.9-2.9V2.9C20 1.3 18.7 0 17.1 0H2.9zm13.2 3.8L11.5 9l5.5 7.2h-4.3l-3.3-4.4-3.8 4.4H3.4l5-5.7-5.3-6.7h4.4l3 4 3.5-4h2.1zM14.4 15 6.8 5H5.6l7.7 10h1.1z"/>
                                            </svg>
                                        </span>
                                    </a>
                                    <a href="tel:0502778822" data-network="phone" aria-label="الهاتف" rel="noopener" >
                                        <span class="ct-icon-container" >
                                            <svg width="20" height="20" viewBox="0 0 20 20" aria-hidden="true">
                                                <path d="M4.8,0C2.1,0,0,2.1,0,4.8v10.5C0,17.9,2.1,20,4.8,20h10.5c2.6,0,4.8-2.1,4.8-4.8V4.8C20,2.1,17.9,0,15.2,0H4.3zM6.7,3.8C7,3.8,7.2,4,7.4,4.3C7.6,4.6,7.9,5,8.3,5.6c0.3,0.5,0.4,1.2,0.1,1.8l-0.7,1C7.4,8.7,7.4,9,7.5,9.3c0.2,0.5,0.6,1.2,1.3,1.9c0.7,0.7,1.4,1.1,1.9,1.3c0.3,0.1,0.6,0.1,0.9-0.1l1-0.7c0.6-0.3,1.3-0.3,1.8,0.1c0.6,0.4,1.1,0.7,1.3,0.9c0.3,0.2,0.4,0.4,0.4,0.7c0.1,1.7-1.2,2.4-1.6,2.4c-0.3,0-3.4,0.4-7-3.2s-3.2-6.8-3.2-7C4.3,5.1,5,3.8,6.7,3.8z"/>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
