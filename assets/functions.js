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
