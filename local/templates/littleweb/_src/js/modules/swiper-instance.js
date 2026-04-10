import Swiper from "swiper";
import { Autoplay, Navigation, Pagination, Thumbs } from "swiper/modules";

// Регистрируем нужные модули глобально
Swiper.use([Navigation, Pagination, Thumbs, Autoplay]);
// Экспортируем для внешнего использования
window.Swiper = Swiper;
