!function(){"use strict";window.onpageshow=function(t){t.persisted&&window.location.reload()},function(){const t=document.querySelector('meta[name="viewport"]');function e(){const e=window.outerWidth>375?"width=device-width,initial-scale=1":"width=375";t.getAttribute("content")!==e&&t.setAttribute("content",e)}addEventListener("resize",e,!1),e()}(),window.addEventListener("DOMContentLoaded",(function(){document.querySelector(".splide")&&new Splide(".splide",{arrows:!1,autoplay:!0,interval:3e3,speed:500,type:"fade",rewind:!0,pauseOnHover:!1,pauseOnFocus:!1,classes:{pagination:"splide__pagination bl_slider_dots"}}).mount()})),function(t){const e=()=>{const e=t(window).scrollTop(),a=t(".js_header");a.height()<e?a.addClass("is_active"):a.removeClass("is_active")},a=()=>{const e=t(window).scrollTop(),a=t(".js_scrollTop");e>=50?a.fadeIn():a.fadeOut();const o=window.innerHeight,r=t(".ly_footer").offset().top;if(e+o>=r){const a=e+o-r-30;t(".el_scrollTop").css("bottom",a)}else t(".el_scrollTop").css("bottom","10px")};window.addEventListener("scroll",(()=>{e(),a()})),window.addEventListener("load",(()=>{t(".bl_loading").delay(1500).fadeOut(),e(),a()})),t(".js_drawer").on("click",(function(){const e=t(this).attr("aria-expanded"),a=t(".bl_drawerNav");"false"===e?(t(this).attr("aria-expanded",!0).attr("aria-label","メニューを閉じる場合はこちら"),a.attr("aria-hidden",!1),t(".bl_drawer_txt").text("Close"),t(".bl_drawer_wrapper").css("backgroundColor","#333"),t(".js_body").addClass("is_active")):(t(this).attr("aria-expanded",!1).attr("aria-label","メニューを開く場合はこちら"),a.attr("aria-hidden",!0),t(".bl_drawer_txt").text("Menu"),t(".bl_drawer_wrapper").css("backgroundColor","transparent"),t(".js_body").removeClass("is_active"))})),t(".js_drawerNav a").on("click",(function(){const e=t(".bl_drawerNav");t(".js_drawer").attr("aria-expanded",!1).attr("aria-label","メニューを開く場合はこちら"),e.attr("aria-hidden",!0),t(".bl_drawer_txt").text("Menu"),t(".bl_drawer_wrapper").css("backgroundColor","transparent"),t(".js_body").removeClass("is_active")})),t('a[href^="#"]').on("click",(function(){const e=t(".ly_header").outerHeight(),a=t(this).attr("href"),o=t("#"==a||""==a?"html":a).offset().top-e-10;return t("body, html").animate({scrollTop:o},200,"swing"),!1})),t(".js_scrollTop > button").on("click",(function(){t("body, html").animate({scrollTop:0},200,"swing")}))}(jQuery)}();