import { RegisterModel } from '../models/register-model.js';
import { RegisterView } from '../views/register-view.js';
import { RegisterContr } from '../controllers/register-contr.js';

$(async () => {
  const registerContr = new RegisterContr(new RegisterModel(), new RegisterView());

  await registerContr.init();
});
