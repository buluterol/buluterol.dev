// JavaScript
function goMenu(className, button) {
    $(".screens").removeClass("fade-in").addClass("fade-out"); // Önceki ekranı fade-out animasyonuyla kaydır
    setTimeout(function () {
        $(".screens").hide(); // Önceki ekranı gizle
        $("." + className).show(); // Yeni ekranı göster
        $("." + className).removeClass("fade-out").addClass("fade-in"); // Yeni ekranı fade-in animasyonuyla göster
    }, 500); // 500ms'lik animasyon süresi
    screenName = className;
    console.log(screenName);
    $("nav button").removeClass("active");
    $(button).addClass("active");
}


$(document).ready(function() {
    // Tüm formların submit olayını ele alalım
    $('form').on('submit', function(event) {
      event.preventDefault(); // Formun normal submit işlemini engelle
      var form = $(this); // Gönderilen formu seç
  
      // AJAX isteği gönder
      $.ajax({
        type: form.attr('method'), // Formun methodunu al
        url: form.attr('action'), // Formun action alanını al
        data: form.serialize(), // Formdaki tüm alanları veri olarak al
        success: function(response) {
          // Başarılı bir şekilde cevap alındığında
          form.find(':input').val(''); // Formdaki tüm input alanlarını temizle
          form.append('<p>Your message received us. We will contact you soon. Thank you.</p>'); // Formun sonuna teşekkür mesajını ekle
        },
        error: function() {
          alert('Form submission failed.'); // Başarısızlık durumunda bir hata mesajı göster
        }
      });
    });
  });