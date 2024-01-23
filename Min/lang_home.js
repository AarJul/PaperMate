const languageLinks = document.querySelectorAll(".dropdown-item");
const includedLanguagesArray = a.includedLanguages.split(',');  // Sử dụng dấu phân cách phù hợp


languageLinks.forEach(link => {
  link.addEventListener("click", () => {
    const targetLanguage = link.textContent;

    // Thay đổi ngôn ngữ dịch của Google Translate
    googleTranslateElementInit(targetLanguage);
  });
});

function googleTranslateElementInit(targetLanguage) {
  new google.translate.TranslateElement({
    pageLanguage: 'en', // Ngôn ngữ mặc định
    includedLanguages: ['en', 'vi', 'id', 'ja'],
  }, 'google_translate_element');

  // Cài đặt ngôn ngữ đích
  const translateElement = document.querySelector('.goog-te-menu-value');
  if (translateElement) {
    translateElement.value = targetLanguage;
  }

  // Bắt đầu dịch
  const startTranslateButton = document.querySelector('.goog-te-menu-value > span');
  if (startTranslateButton) {
    startTranslateButton.click();
  }
}

$(document).ready(function() {
  // Xử lý sự kiện khi người dùng chọn ngôn ngữ
  $('.dropdown-menu a').click(function() {
    var language = $(this).text();
    googleTranslateElementInit(language);
    // Cập nhật tiêu đề nút nếu cần
    $('.dropdown-toggle').text(language);
  });
});
