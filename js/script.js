// DOM Elements
const navToggle = document.getElementById('nav-toggle');
const navMenu = document.getElementById('nav-menu');
const navLinks = document.querySelectorAll('.nav-link');
const filterBtns = document.querySelectorAll('.filter-btn');
const portfolioItems = document.querySelectorAll('.portfolio-item');
const contactForm = document.getElementById('contactForm');

// Hero Slideshow
let currentSlide = 0;
const slides = document.querySelectorAll('.hero-slide');// الصور

const subtitle = document.querySelector('.hero-subtitle'); // الفقرة
const texts = [
  "نحن نقدم خدمات شاملة في فحص المباني وتقنيات BIM والتصميم المعماري باستخدام أحدث التقنيات العالمية",
  "نستخدم أدوات تحليل متقدمة لضمان جودة التصميم وسلامة المنشآت",
  "خبرتنا تمتد إلى مشاريع سكنية وتجارية وصناعية بأعلى المعايير"
];

function nextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
    // تغيير النص حسب الشريحة الحالية
  subtitle.textContent = texts[currentSlide];
}

 

// Change slide every 5 seconds كل 5 ثواني
setInterval(nextSlide, 5000);
 
// Mobile Navigation Toggle
navToggle.addEventListener('click', () => {
    navMenu.classList.toggle('active');
    navToggle.classList.toggle('active');
});

// Close mobile menu when clicking on a link
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('active');
        navToggle.classList.remove('active');
    });
});

// Smooth Scrolling for Navigation Links
navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();//يمنع السلوك الافتراضي للرابط
        const targetId = link.getAttribute('href');
        const targetSection = document.querySelector(targetId);
        
        if (targetSection) {
            const headerHeight = document.querySelector('.header').offsetHeight;
            const targetPosition = targetSection.offsetTop - headerHeight;
            
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'//يعني بشكل سلس
            });
        }
    });
});

// Active Navigation Link on Scroll
//تمييز الرابط النشط في شريط التنقل أثناء التمرير
window.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('section');
    const scrollPosition = window.scrollY + 100;
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;
        const sectionId = section.getAttribute('id');
        
        if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${sectionId}`) {
                    link.classList.add('active');
                }
            });
        }
    });
});

// Portfolio Filter
//فلترة عناصر البورتفوليو (Portfolio Filter)
filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        // Remove active class from all buttons
        filterBtns.forEach(button => button.classList.toggle('active'));
        // Add active class to clicked buttonclassList.toggle
        btn.classList.add('active');
        
        const filterValue = btn.getAttribute('data-filter');
        
        portfolioItems.forEach(item => {
            if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                item.style.display = 'block';
                item.style.animation = 'fadeInUp 0.5s ease';
            } else {
                item.style.display = 'none';
            }
        });
    });
});

// Contact Form Handling

const formMessage = document.getElementById('formMessage');
const submitBtn = document.getElementById('button[type="submit"]');

contactForm.addEventListener('submit', (e) => {
  e.preventDefault();

  // تعطيل الزر مؤقتًا
  submitBtn.disabled = true;
  submitBtn.textContent = 'جاري الإرسال...';

  const formData = new FormData(contactForm);

  const name = formData.get('name');
  const email = formData.get('email');
  const phone = formData.get('phone');
  const service = formData.get('service');
  const message = formData.get('message');

  // تحقق من الحقول
  if (!name || !email || !phone || !service || !message) {
    showMessage('يرجى ملء جميع الحقول المطلوبة', 'error');
    resetButton();
    return;
  }

  // تحقق من البريد
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email.trim())) {
    showMessage('يرجى إدخال بريد إلكتروني صحيح', 'error');
    resetButton();
    return;
  }

  // تحقق من الهاتف السعودي
  const cleanedPhone = phone.replace(/\s/g, '');
  const phoneRegex = /^(\+966|966|0)?5[0-9]{8}$/;
  if (!phoneRegex.test(cleanedPhone)) {
    showMessage('يرجى إدخال رقم هاتف سعودي صحيح مثل: 0501234567 أو +966501234567', 'error');
    resetButton();
    return;
  }

  // إرسال البيانات
  fetch('send-email.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    showMessage('✅ تم إرسال الرسالة بنجاح، سنقوم بالرد عليك قريبًا', 'success');
    contactForm.reset();
    resetButton();
  })
  .catch(err => {
    showMessage('❌ حدث خطأ أثناء الإرسال، يرجى المحاولة لاحقًا', 'error');
    resetButton();
  });
});

// دالة عرض الرسالة
function showMessage(text, type) {
  formMessage.textContent = text;
  formMessage.className = `form-message ${type}`;
  formMessage.style.display = 'block';
}

// دالة إعادة تفعيل الزر
function resetButton() {
  submitBtn.disabled = false;
  submitBtn.textContent = 'أرسل الطلب';
}




// if (contactForm) {
//     contactForm.addEventListener('submit', (e) => {
//         e.preventDefault();//يمنع الإرسال التقليدي للنموذج
        
//         // Get form data
//         const formData = new FormData(contactForm);//يستخدم FormData لاستخراج القيم من الحقول
//         const name = formData.get('name');
//         const email = formData.get('email');
//         const phone = formData.get('phone');
//         const service = formData.get('service');
//         const message = formData.get('message');
        
//         // Basic validation
//         if (!name || !email || !phone || !service || !message) {
//             alert('يرجى ملء جميع الحقول المطلوبة');
//             return;
//         }
        
//         // Email validation
//         const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//         if (!emailRegex.test(email)) {
//             alert('يرجى إدخال بريد إلكتروني صحيح');
//             return;
//         }
        
//         // Phone validation (Saudi format)
//         const phoneRegex = /^(\+966|966|0)?[5][0-9]{8}$/;
//         if (!phoneRegex.test(phone.replace(/\s/g, ''))) {
//             alert('يرجى إدخال رقم هاتف صحيح');
//             return;
//         }
        
        // Simulate form submission
        // const submitBtn = contactForm.querySelector('button[type="submit"]');
        // const originalText = submitBtn.textContent;
        // submitBtn.textContent = 'جاري الإرسال...';
        // submitBtn.disabled = true;
        
//         setTimeout(() => {
//             alert('تم إرسال طلبكم بنجاح! سنتواصل معكم قريباً.');
//             contactForm.reset();
//             submitBtn.textContent = originalText;
//             submitBtn.disabled = false;
//         }, 2000);
//     });
// }





// Scroll Animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animation = 'fadeInUp 0.8s ease forwards';
        }
    });
}, observerOptions);

// Observe elements for animation
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.service-card, .step, .portfolio-item, .testimonial-card, .value-item');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        observer.observe(el);
    });
});

// Statistics Counter Animation
const statsNumbers = document.querySelectorAll('.stat-number');

const animateCounter = (element, target) => {
    const increment = target / 100;
    let current = 0;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        
        // Format number with + sign
        const formattedNumber = Math.floor(current);
        element.textContent = formattedNumber + '+';
    }, 20);
};

// Trigger counter animation when stats section is visible
const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            statsNumbers.forEach(stat => {
                const target = parseInt(stat.textContent.replace('+', ''));
                animateCounter(stat, target);
            });
            statsObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });

const statsSection = document.querySelector('.stats');
if (statsSection) {
    statsObserver.observe(statsSection);
}

// Header Background on Scroll
window.addEventListener('scroll', () => {
    const header = document.querySelector('.header');
    if (window.scrollY > 100) {
        header.style.background = 'rgba(255, 255, 255, 0.98)';
        header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
    } else {
        header.style.background = 'rgba(255, 255, 255, 0.95)';
        header.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
    }
});

// Smooth reveal animations for sections
const revealSections = document.querySelectorAll('section');
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
        }
    });
}, {
    threshold: 0.15
});

revealSections.forEach(section => {
    revealObserver.observe(section);
});

// Add CSS for reveal animation
const style = document.createElement('style');
style.textContent = `
    section {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease;
    }
    
    section.revealed {
        opacity: 1;
        transform: translateY(0);
    }
    
    .hero {
        opacity: 1;
        transform: none;
    }
`;
document.head.appendChild(style);

// Parallax effect for hero section
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const heroImage = document.querySelector('.hero-image');
    if (heroImage) {
        heroImage.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});

// Service cards hover effect
const serviceCards = document.querySelectorAll('.service-card');
serviceCards.forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'translateY(-10px) scale(1.02)';
    });
    
    card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0) scale(1)';
    });
});

// Loading animation
window.addEventListener('load', () => {
    document.body.classList.add('loaded');
});

// Add loading styles
const loadingStyle = document.createElement('style');
loadingStyle.textContent = `
    body {
        opacity: 0;
        transition: opacity 0.5s ease;
    }
    
    body.loaded {
        opacity: 1;
    }
`;
document.head.appendChild(loadingStyle);



// Comments System


// Service Requests System
class RequestsSystem {
    constructor() {
        
        this.apiUrl = 'requests.php';
        this.init();//تُستخدم لتهيئة النموذج أو تحميل التعليقات
    }

    init() {
        this.setupRequestForm();
    }

    setupRequestForm() {
        const contactForm = document.getElementById('contactForm');
        if (!contactForm) return;

        contactForm.addEventListener('submit', (e) => this.handleRequestSubmit(e));
    }

    async handleRequestSubmit(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const data = {
            name: formData.get('name'),
            email: formData.get('email'),
            phone: formData.get('phone'),
            service: formData.get('service'),
            message: formData.get('message')
        };

        // Show loading state
        const submitBtn = e.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'جاري الإرسال...';
        submitBtn.disabled = true;

        try {
            const response = await fetch(this.apiUrl, {//يرسل البيانات إلى الخادم وينتظر الرد
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            
            if (result.success) {
                alert(result.message);
                e.target.reset();
            } else {
                alert('خطأ: ' + result.error);
            }
        } catch (error) {
            console.error('Error submitting request:', error);
            alert('حدث خطأ أثناء إرسال الطلب. يرجى المحاولة مرة أخرى.');
        } finally {
            // Restore button state
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }
    }
}

// Initialize systems when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new CommentsSystem();
    new RequestsSystem();
});


// Social Media Toggle System
class SocialMediaToggle {
    constructor() {
        this.socialToggle = document.getElementById('socialToggle');
        this.fixedSocial = document.getElementById('fixedSocial');
        this.socialClose = document.getElementById('socialClose');
        this.isVisible = false;
        
        this.init();
    }

    init() {
        if (!this.socialToggle || !this.fixedSocial || !this.socialClose) {
            console.error('Social media elements not found');
            return;
        }

        // Show social icons by default on first visit
        this.showSocialIcons();
        
        // Hide after 5 seconds initially
        setTimeout(() => {
            if (this.isVisible) {
                this.hideSocialIcons();
            }
        }, 5000);

        this.setupEventListeners();
    }

    setupEventListeners() {
        // Toggle button click
        this.socialToggle.addEventListener('click', () => {
            if (this.isVisible) {
                this.hideSocialIcons();
            } else {
                this.showSocialIcons();
            }
        });

        // Close button click
        this.socialClose.addEventListener('click', () => {
            this.hideSocialIcons();
        });

        // Hide when clicking outside
        document.addEventListener('click', (e) => {
            if (this.isVisible && 
                !this.fixedSocial.contains(e.target) && 
                !this.socialToggle.contains(e.target)) {
                this.hideSocialIcons();
            }
        });

        // Auto-hide after inactivity
        let hideTimer;
        this.fixedSocial.addEventListener('mouseenter', () => {
            clearTimeout(hideTimer);
        });

        this.fixedSocial.addEventListener('mouseleave', () => {
            hideTimer = setTimeout(() => {
                if (this.isVisible) {
                    this.hideSocialIcons();
                }
            }, 3000);
        });

        // Track social media clicks
        const socialLinks = this.fixedSocial.querySelectorAll('.social-link');
        socialLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                const platform = link.classList[1]; // Get the platform class name
                console.log(`Social media click: ${platform}`);
                
                // Add click animation
                link.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    link.style.transform = '';
                }, 150);
            });
        });
    }

    showSocialIcons() {
        this.fixedSocial.classList.add('active');
        this.isVisible = true;
        
        // Add entrance animation to individual icons
        const socialLinks = this.fixedSocial.querySelectorAll('.social-link');
        socialLinks.forEach((link, index) => {
            link.style.opacity = '0';
            link.style.transform = 'translateX(-20px)';
            
            setTimeout(() => {
                link.style.transition = 'all 0.3s ease';
                link.style.opacity = '1';
                link.style.transform = 'translateX(0)';
            }, index * 100);
        });
    }

    hideSocialIcons() {
        this.fixedSocial.classList.remove('active');
        this.isVisible = false;
    }
}

// Initialize social media toggle when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new SocialMediaToggle();
});


// Portfolio Dynamic Loading
class PortfolioManager {
    constructor() {
        this.portfolioGrid = document.querySelector('.portfolio-grid');
        this.filterButtons = document.querySelectorAll('.filter-btn');
        this.projects = [];
        this.currentFilter = 'all';
        
        this.init();
    }
    
    async init() {
        await this.loadProjects();
        this.setupFilters();
        this.renderProjects();
    }
    
    async loadProjects() {
        try {
            const response = await fetch('portfolio_api.php');
            const data = await response.json();
            
            if (data.success) {
                this.projects = data.projects;
            } else {
                console.error('Failed to load projects:', data.message);
            }
        } catch (error) {
            console.error('Error loading projects:', error);
            // Use fallback projects if API fails
            this.projects = this.getFallbackProjects();
        }
    }
    
    getFallbackProjects() {
        return [
            {
                id: 'fallback_1',
                title: 'فحص مجمع سكني',
                description: 'فحص شامل لمجمع سكني من 50 وحدة',
                category: 'residential',
                image: 'images/residential_inspection.jpg'
            },
            {
                id: 'fallback_2',
                title: 'تقييم مبنى تجاري',
                description: 'تقييم شامل لمبنى تجاري في الرياض',
                category: 'commercial',
                image: 'images/building_assessment.jpg'
            },
            {
                id: 'fallback_3',
                title: 'نمذجة BIM',
                description: 'نمذجة ثلاثية الأبعاد لمشروع سكني',
                category: 'bim',
                image: 'images/bim_technology.png'
            }
        ];
    }
    
    setupFilters() {
        this.filterButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                // Remove active class from all buttons
                this.filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                e.target.classList.add('active');
                
                // Update current filter
                this.currentFilter = e.target.dataset.filter;
                
                // Re-render projects
                this.renderProjects();
            });
        });
    }
    
    renderProjects() {
        if (!this.portfolioGrid) return;
        
        // Filter projects based on current filter
        const filteredProjects = this.currentFilter === 'all' 
            ? this.projects 
            : this.projects.filter(project => project.category === this.currentFilter);
        
        // Clear existing content
        this.portfolioGrid.innerHTML = '';
        
        // Render filtered projects
        filteredProjects.forEach((project, index) => {
            const projectElement = this.createProjectElement(project);
            this.portfolioGrid.appendChild(projectElement);
            
            // Add entrance animation
            setTimeout(() => {
                projectElement.style.opacity = '1';
                projectElement.style.transform = 'translateY(0)';
            }, index * 100);
        });
        
        // Show message if no projects found
        if (filteredProjects.length === 0) {
            this.portfolioGrid.innerHTML = `
                <div class="no-projects-message" style="
                    grid-column: 1 / -1;
                    text-align: center;
                    padding: 40px;
                    color: #7f8c8d;
                ">
                    <i class="fas fa-folder-open" style="font-size: 3rem; margin-bottom: 15px; opacity: 0.5;"></i>
                    <p>لا توجد مشاريع في هذه الفئة</p>
                </div>
            `;
        }
    }
    
    createProjectElement(project) {
        const projectDiv = document.createElement('div');
        projectDiv.className = 'portfolio-item';
        projectDiv.dataset.category = project.category;
        projectDiv.style.opacity = '0';
        projectDiv.style.transform = 'translateY(20px)';
        projectDiv.style.transition = 'all 0.5s ease';
        
        projectDiv.innerHTML = `
            <img src="${project.image}" alt="${project.title}" onerror="this.src='images/placeholder.jpg'">
            <div class="portfolio-overlay">
                <h3>${project.title}</h3>
                <p>${project.description}</p>
            </div>
        `;
        
        return projectDiv;
    }
    
    // Method to refresh projects (can be called after adding new projects)
    async refresh() {
        await this.loadProjects();
        this.renderProjects();
    }
}

// Initialize portfolio manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Only initialize if portfolio section exists
    if (document.querySelector('.portfolio-grid')) {
        window.portfolioManager = new PortfolioManager();
    }
});

// Auto-refresh portfolio every 30 seconds to show new projects
setInterval(() => {
    if (window.portfolioManager) {
        window.portfolioManager.refresh();
    }
}, 30000);

