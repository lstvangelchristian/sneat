import { BlogModel } from '../models/blog-model.js';
import { BlogView } from '../views/blog-view.js';
import { BlogContr } from '../controllers/blog-contr.js';
import { showResult } from '../utils/sweetalert2.js';

$(async () => {
  const blogContr = new BlogContr(new BlogModel(), new BlogView(), showResult);

  await blogContr.init();
});
