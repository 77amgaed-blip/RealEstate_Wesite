

// //   // ✅ دالة توليد النجوم حسب التقييم
// //   function generateStars(rating) {
// //     let stars = '';
// //     for (let i = 1; i <= 5; i++) {
// //       stars += i <= rating ? '★' : '☆';
// //     }
// //     return stars;
// //   }
// // 


document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('comment-form');
  const messageBox = document.getElementById('form-message');

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    const name = formData.get('name').trim();
    const email = formData.get('email').trim();
    const rating = parseInt(formData.get('rating'));
    const comment = formData.get('comment').trim();

    if (!name || !email || !comment || !(rating >= 1 && rating <= 5)) {
      showMessage('يرجى ملء جميع الحقول بشكل صحيح.', 'red');
      return;
    }

    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'جارٍ الإرسال...';
    submitBtn.disabled = true;

    fetch('comments.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.text())
    .then(result => {
      // ✅ تحليل الرد النصي من PHP
      if (result.includes('تم إرسال التعليق')) {
        showMessage('تم إرسال التعليق بنجاح.', 'green');
        form.reset();
      } else if (result.includes('خطأ') || result.includes('فشل')) {
        showMessage('خطأ: ' + result, 'red');
      } else {
        showMessage('رد غير متوقع من الخادم: ' + result, 'red');
      }
    })
    .catch(err => {
      console.error('خطأ أثناء الإرسال:', err);
      showMessage('حدث خطأ أثناء إرسال التعليق. يرجى المحاولة لاحقًا.', 'red');
    })
    .finally(() => {
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
    });
  });

  function showMessage(text, color) {
    messageBox.textContent = text;
    messageBox.style.color = color;
    messageBox.style.opacity = '1';
    messageBox.style.display = 'block';

    setTimeout(() => {
      messageBox.style.opacity = '0';
      setTimeout(() => {
        messageBox.style.display = 'none';
        messageBox.textContent = '';
      }, 500);
    }, 5000);
  }
});
