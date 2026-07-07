/**
 * 病院ブログテーマ – メインスクリプト
 *
 * @package hospital-theme
 */

(function () {
    'use strict';

    // ===== モバイルメニューの開閉 =====
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav    = document.querySelector('.main-navigation');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function () {
            const isOpen = mainNav.classList.toggle('is-open');
            menuToggle.setAttribute('aria-expanded', String(isOpen));
        });

        // メニュー外クリックで閉じる
        document.addEventListener('click', function (event) {
            if (
                mainNav.classList.contains('is-open') &&
                !mainNav.contains(event.target) &&
                event.target !== menuToggle
            ) {
                mainNav.classList.remove('is-open');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // ===== スムーズスクロール（アンカーリンク） =====
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (event) {
            const targetId = this.getAttribute('href').slice(1);
            if (!targetId) return;
            const target = document.getElementById(targetId);
            if (target) {
                event.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                target.focus({ preventScroll: true });
            }
        });
    });

    // ===== 電話番号のタップ/クリック強調 =====
    document.querySelectorAll('a[href^="tel:"]').forEach(function (link) {
        link.style.fontWeight = '700';
    });

})();
