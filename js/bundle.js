!function(){"use strict";window.onpageshow=function(t){t.persisted&&window.location.reload()},function(){const t=document.querySelector('meta[name="viewport"]');function e(){const e=window.outerWidth>360?"width=device-width,initial-scale=1":"width=360";t.getAttribute("content")!==e&&t.setAttribute("content",e)}addEventListener("resize",e,!1),e()}(),function(t){const e=()=>{let e=t(window).scrollTop(),a=t(".js_header");a.height()<e?a.addClass("is_active"):a.removeClass("is_active")},a=()=>{let e=t(window).scrollTop(),a=t(".js_scrollTop");e>=20?a.fadeIn():a.fadeOut();let r=window.innerHeight,o=t(".ly_footer").offset().top;if(e+r>=o){let a=e+r-o-30;t(".el_scrollTop").css("bottom",a)}else t(".el_scrollTop").css("bottom","10px")};t(window).on("scroll",(function(){e(),a()})),t(window).on("load",(function(){t(".bl_loading").delay(1500).fadeOut(),e(),a()})),t(".js_drawer").on("click",(function(){const e=t(this).attr("aria-expanded"),a=t(".bl_drawerNav");"false"===e?(t(this).attr("aria-expanded",!0).attr("aria-label","メニューを閉じる場合はこちら"),a.attr("aria-hidden",!1),t(".bl_drawer_txt").text("Close"),t(".bl_drawer_wrapper").css("backgroundColor","#333"),t(".js_body").addClass("is_active")):(t(this).attr("aria-expanded",!1).attr("aria-label","メニューを開く場合はこちら"),a.attr("aria-hidden",!0),t(".bl_drawer_txt").text("Menu"),t(".bl_drawer_wrapper").css("backgroundColor","transparent"),t(".js_body").removeClass("is_active"))})),t(".js_drawerNav a").on("click",(function(){const e=t(".bl_drawerNav");t(".js_drawer").attr("aria-expanded",!1).attr("aria-label","メニューを開く場合はこちら"),e.attr("aria-hidden",!0),t(".bl_drawer_txt").text("Menu"),t(".bl_drawer_wrapper").css("backgroundColor","transparent"),t(".js_body").removeClass("is_active")})),t('a[href^="#"]').on("click",(function(){let e=t(".ly_header").outerHeight(),a=t(this).attr("href"),r=t("#"==a||""==a?"html":a).offset().top-e-10;return t("body, html").animate({scrollTop:r},500,"swing"),!1})),t(".js_scrollTop > button").on("click",(function(){t("body, html").animate({scrollTop:0},200,"swing")}))}(jQuery)}();
