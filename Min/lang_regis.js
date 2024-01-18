const languageData = {};
const loadLanguageData = async (lang) => {
    try {
      const response = await fetch(`../Min/json/${lang}.json`);
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
    updateLanguageContent(lang);

    const dropdownButton = document.querySelector('.dropdown-toggle');
    dropdownButton.textContent = getLanguageText(lang);
}

// Update the UI content with the current language
const updateLanguageContent = () => {
    const regisData = languageData[currentLanguage]['register'];

    const title = document.querySelector("h2");
    const username = document.querySelector(".username");
    const email = document.querySelector("#email");
    const password = document.querySelector("#password1"); 
    const rePassword = document.querySelector("#rePassword"); 
    const telephone = document.querySelector("#tel");
    const preferredLanguage = document.querySelector("#languageLabel"); 
    const usernamePlaceholder = document.querySelector("input[placeholder='Enter Username']");
    const emailPlaceholder = document.querySelector("input[placeholder='Enter email']");
    const passwordPlaceholder = document.querySelector("input[placeholder='Enter password']");
    const rePasswordPlaceholder = document.querySelector("input[placeholder='Re-Enter password']");
    const telephonePlaceholder = document.querySelector("input[placeholder='Enter Telephone']");
    const registerButton = document.querySelector("button[name='register']"); 


    title.textContent = regisData.RegisterNewAccount;
    username.textContent = regisData.Username;
    email.textContent = regisData.Email;
    password.textContent = regisData.Password;
    rePassword.textContent = regisData.ReenterPassword;
    telephone.textContent = regisData.Telephone;
    preferredLanguage.textContent = regisData.PreferredLanguage
    usernamePlaceholder.placeholder = regisData.UsernamePlaceholder;
    emailPlaceholder.placeholder = regisData.EmailPlaceholder;
    passwordPlaceholder.placeholder = regisData.PasswordPlaceholder;
    rePasswordPlaceholder.placeholder = regisData.ReenterPasswordPlaceholder;
    telephonePlaceholder.placeholder = regisData.TelePlaceholder;
    registerButton.textContent = regisData.REGISTER;

};


// Attach event listener to dropdown menu items
const dropdownItems = document.querySelectorAll(".change-lang");
dropdownItems.forEach((item) => item.addEventListener("click", async (event) => {
    currentLanguage = event.target.dataset.lang;
    if (!languageData[currentLanguage]) {
        console.log(currentLanguage)
        await loadLanguageData(currentLanguage);
        setLanguage(currentLanguage);
        updateLanguageContent(); // Gọi hàm cập nhật nội dung sau khi dữ liệu đã được tải xong
    } else {
        updateLanguageContent();
    }
}));


  
  