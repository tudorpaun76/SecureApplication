const { registerTest } = require('playwright');

(async () => {
  const browser = await registerTest.launch();
  const context = await browser.newContext();
  const page = await context.newPage();

  await page.goto('register.php');

  await page.fill('input[name="username"]', 'test_user');
  await page.fill('input[name="password"]', 'test_password');

  await Promise.all([
    page.waitForNavigation(), 
    page.click('button[name="register"]'),
  ]);

  if(page.url().includes('register.php')){
    console.log('Registration successful!')
  } else {
    console.log('Registration failed!')
  }

  await browser.close();
})();
