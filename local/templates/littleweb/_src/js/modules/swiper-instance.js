import Swiper from "swiper";
import { Autoplay, Navigation, Pagination, Thumbs } from "swiper/modules";

export const initSwiperInstance = () => {
	Swiper.use([Navigation, Pagination, Thumbs, Autoplay]);
	window.Swiper = Swiper;
};
