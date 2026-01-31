<?php
include('./conect/counect.php');

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title>BS_BIM - حلول متقدمة في تقنيات البناء والفحص العقاري | BIM Technology</title>
    <meta name="description" content="شركة BS.BIM تقدم حلول متقدمة في تقنيات البناء، فحص العقارات، والتصميم المعماري باستخدام أحدث تقنيات BIM في السعودية">
    <meta name="keywords" content="BIM, تقنيات البناء, فحص العقارات, التصميم المعماري, نمذجة معلومات البناء, السعودية, جدة, الرياض">
    <meta name="author" content="BS.BIM">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Arabic">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="BS.BIM - حلول متقدمة في تقنيات البناء والفحص العقاري">
    <meta property="og:description" content="شركة رائدة في تقنيات البناء الحديثة والفحص العقاري المتقدم باستخدام تقنيات BIM">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://bs-bim.com">
    <meta property="og:image" content="images/bs_bim_logo_official.jpg">
    <meta property="og:locale" content="ar_SA">
    <meta property="og:site_name" content="BS.BIM">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="BS.BIM - حلول متقدمة في تقنيات البناء والفحص العقاري">
    <meta name="twitter:description" content="شركة رائدة في تقنيات البناء الحديثة والفحص العقاري المتقدم باستخدام تقنيات BIM">
    <meta name="twitter:image" content="images/bs_bim_logo_official.jpg">
    
    <!-- Favicon and Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="manifest" href="site.webmanifest">
    <meta name="theme-color" content="#1e3a8a">
    <meta name="msapplication-TileColor" content="#1e3a8a">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://bs-bim.com">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
   
      
</head>
<body>
    <!-- Fixed Social Media Icons with Toggle -->
    <div class="social-toggle-btn" id="socialToggle" title="إظهار/إخفاء وسائل التواصل">
        <i class="fas fa-share-alt"></i>
    </div>
    
    <div class="fixed-social" id="fixedSocial">
        <div class="social-close-btn" id="socialClose" title="إخفاء">
            <!-- <i class="fas fa-times"></i> -->
        </div>

         <div>     <a href="https://facebook.com/bs.bim" target="_blank" title="Facebook" class="social-link facebook">
            <i class="fab fa-facebook-f"></i>
            <span class="social-label"></span>
        </a>
    </div>



          <div>    <a href="https://linkedin.com/company/bs-bim" target="_blank" title="LinkedIn" class="social-link linkedin">
            <i class="fab fa-linkedin-in"></i>
            <span class="social-label"></span>
        </a></div>
       
           <div>
             <a href="https://instagram.com/bs.bim" target="_blank" title="Instagram" class="social-link instagram">
            <i class="fab fa-instagram"></i>
            <span class="social-label"></span>
        </a>
           </div>
             <div>

             <a href="https://wa.me/966501234567" target="_blank" title="WhatsApp" class="social-link whatsapp">
            <i class="fab fa-whatsapp"></i>
            <span class="social-label"></span>
        </a>
             </div>
      
          <div>
             <a href="https://t.me/bs_bim" target="_blank" title="Telegram" class="social-link telegram">
            <i class="fab fa-telegram-plane"></i>
            <span class="social-label"></span>
        </a>
          </div>
    </div>

    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="container">
                <div class="nav-brand">
                    <div class="logo-container">
                        <img src="images/bs_bim_logo_official.jpg" alt="BS.BIM Logo" class="logo">
                        <div class="company-name">
                            <span class="company-title">BS_BIM</span>
                      
                        </div>
                    </div>
                </div>
                <div class="nav-menu" id="nav-menu">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a href="#home" class="nav-link active">الرئيسية</a>
                        </li>
                        <li class="nav-item">
                            <a href="#about" class="nav-link">نبذة عنا</a>
                        </li>
                        <li class="nav-item">
                            <a href="#services" class="nav-link">خدماتنا</a>
                        </li>
                        <li class="nav-item">
                            <a href="#work-process" class="nav-link">آلية العمل</a>
                        </li>
                        <li class="nav-item">
                            <a href="#portfolio" class="nav-link">أعمالنا</a>
                        </li>
                        <li class="nav-item">
                            <a href="#testimonials" class="nav-link">آراء العملاء</a>
                        </li>
                        <li class="nav-item">
                            <a href="#contact" class="nav-link">اتصل بنا</a>
                        </li>
                    </ul>
                </div>
                <div class="nav-toggle" id="nav-toggle">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>