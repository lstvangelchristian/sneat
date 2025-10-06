import { LoginModel } from '../models/login-model.js';
import { LoginView } from '../views/login-view.js';
import { LoginContr } from '../controllers/login-contr.js';

$(async () => {
  const loginContr = new LoginContr(new LoginModel(), new LoginView());

  await loginContr.init();
});
