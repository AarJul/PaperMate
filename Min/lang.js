const languageData = {};
const loadLanguageData = async (lang) => {
    try {
      const response = await fetch(`json/${lang}.json`);
      const data = await response.json();
      languageData[lang] = data;
    } catch (error) {
      console.error(error);
      // Hiển thị thông báo lỗi cho người dùng
    }
};
function getLanguageText(lang) {
    switch (lang) {
        case 'en':
            return 'English';
        case 'vi':
            return 'Tiếng Việt';
        case 'jp':
            return '日本語';
        case 'indo':
            return 'Indonesia';
        default:
            return 'Select Language';
    }
}
// Hàm thiết lập ngôn ngữ
function setLanguage(lang) {
    localStorage.setItem('selectedLang', lang);
    displayLanguageContent(lang);

    const dropdownButton = document.querySelector('.dropdown-toggle');
    dropdownButton.textContent = getLanguageText(lang);
}


// Update the UI content with the current language
const updateLanguageContent = () => {
    const loginData = languageData[currentLanguage]['login'];
    const registerData = languageData[currentLanguage]['register'];

    const titleEl = document.querySelector("h1");
    const subtitleEl = document.querySelector(".specific-subtitle");
    const registerLink = document.querySelector(".new-register");
    const emailInput = document.querySelector("input[name='email']");
    const passwordInput = document.querySelector("input[name='password']");
    const rememberPasswordLabel = document.querySelector("label[for='pass_save']");
    const loginBtn = document.querySelector("button[name='login']");

    const defaultLink = registerLink.getAttribute("data-lang-link");
    registerLink.textContent = loginData.registerText;
    registerLink.href = defaultLink;

    titleEl.textContent = loginData.title;
    subtitleEl.textContent = loginData.subtitle;
    emailInput.placeholder = loginData.emailPlaceholder;
    passwordInput.placeholder = loginData.passwordPlaceholder;
    rememberPasswordLabel.textContent = loginData.rememberPasswordLabel;
    loginBtn.textContent = loginData.loginButton;

    const dropdownButton = document.querySelector('.dropdown-toggle');
    dropdownButton.textContent = getLanguageText(currentLanguage);
};


// Attach event listener to dropdown menu items
const dropdownItems = document.querySelectorAll(".change-lang");
dropdownItems.forEach((item) => item.addEventListener("click", async (event) => {
    currentLanguage = event.target.dataset.lang;
    if (!languageData[currentLanguage]) {
        await loadLanguageData(currentLanguage);
    } else {
        updateLanguageContent();
    }
}));


// Trong sự kiện nhấn vào liên kết "Tại đây" trên trang đăng nhập
const registerLink = document.querySelector(".new-register");
registerLink.addEventListener("click", (event) => {
  event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết

  // Lấy ngôn ngữ hiện tại từ dữ liệu ngôn ngữ đã chọn
  const currentLanguage = localStorage.getItem("currentLanguage"); // Hàm này trả về ngôn ngữ hiện tại, ví dụ 'vi', 'en', 'jp',...

  
  // Chuyển hướng đến trang đăng ký với ngôn ngữ tương ứng
  const registerURL = `../Ivan/newAccount.html?lang=${currentLanguage}`;
  window.location.href = registerURL; // Chuyển hướng đến trang đăng ký với ngôn ngữ tương ứng
});


  
  