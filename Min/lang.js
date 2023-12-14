const languageData = {
    en: {
      title: "Login",
      subtitle: "If you don't have an account, register here",
      emailPlaceholder: "Enter your email",
      passwordPlaceholder: "Enter your password",
      rememberPasswordLabel: "Remember password",
      loginButton: "Login",
    },
    vi: {
      title: "Đăng nhập",
      subtitle: "Nếu bạn chưa có tài khoản, đăng ký ở đây",
      emailPlaceholder: "Nhập email của bạn",
      passwordPlaceholder: "Nhập mật khẩu của bạn",
      rememberPasswordLabel: "Ghi nhớ mật khẩu",
      loginButton: "Đăng nhập",
    },
    jp: {
        title: "ログイン",
        subtitle: "アカウントをお持ちでない方は、新規登録",
        emailPlaceholder: "メールアドレスを入力",
        passwordPlaceholder: "パスワードを入力",
        rememberPasswordLabel: "パスワードを記憶する",
        loginButton: "ログイン",
      },
    indo: {
        title: "Masuk",
        subtitle: "Jika Anda belum memiliki akun, daftar di sini",
        emailPlaceholder: "Masukkan email Anda",
        passwordPlaceholder: "Masukkan kata sandi Anda",
        rememberPasswordLabel: "Ingat kata sandi",
        loginButton: "Masuk",
      },
  };
  
  const defaultLanguage = "en"; // Set your default language here
  
  let currentLanguage = defaultLanguage;
  
  // Change language when clicking on dropdown menu items
  const changeLanguage = (event) => {
    currentLanguage = event.target.dataset.lang;
    updateLanguageContent();
  };
  
  // Update the UI content with the current language
  const updateLanguageContent = () => {
    const languageDataObj = languageData[currentLanguage];
    const titleEl = document.querySelector("h1");
    const subtitleEl = document.querySelector("h4");
    const emailInput = document.querySelector("input[name='email']");
    const passwordInput = document.querySelector("input[name='password']");
    const rememberPasswordLabel = document.querySelector("label[for='pass_save']");
    const loginBtn = document.querySelector("button[name='login']");
  
    titleEl.textContent = languageDataObj.title;
    subtitleEl.textContent = languageDataObj.subtitle;
    emailInput.placeholder = languageDataObj.emailPlaceholder;
    passwordInput.placeholder = languageDataObj.passwordPlaceholder;
    rememberPasswordLabel.textContent = languageDataObj.rememberPasswordLabel;
    loginBtn.textContent = languageDataObj.loginButton;
  };
  
  // Attach event listener to dropdown menu items
  const dropdownItems = document.querySelectorAll(".change-lang");
  dropdownItems.forEach((item) => item.addEventListener("click", changeLanguage));
  
  // Initialize the UI with the default language
  updateLanguageContent();
  