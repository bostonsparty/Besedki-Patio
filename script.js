$(function(){
  $('.gallery__inner-slider').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    // arrows: false
  });
});
$('a[href*="#"]').on('click', function (e) {
  e.preventDefault();

  $('html, body').animate({
    scrollTop: $($(this).attr('href')).offset().top
  }, 500, 'linear');
});





const form = document.getElementById('callback-form');
const nameInput = document.getElementById('name');
const phoneInput = document.getElementById('phone');
const popup = document.getElementById('popup');
const closeBtn = document.querySelector('.close-btn');

// Валидация имени (только буквы)
nameInput.addEventListener('input', () => {
    nameInput.value = nameInput.value.replace(/[^a-zA-Zа-яА-Я\s]/g, '');
});

// Валидация телефона (только цифры)
phoneInput.addEventListener('input', () => {
    phoneInput.value = phoneInput.value.replace(/[^0-9+\s()-]/g, '');
});

// Обработчик отправки формы
form.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(form);

    fetch('send_email.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Показываем попап при успехе
                popup.classList.add('active');
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            alert('Произошла ошибка при отправке данных.');
        });
});

// Закрытие попапа
closeBtn.addEventListener('click', () => {
    popup.classList.remove('active');
});
