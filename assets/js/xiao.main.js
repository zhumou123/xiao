/*!
 * Color mode toggler for Bootstrap's docs (https://getbootstrap.com/)
 * Copyright 2011-2024 The Bootstrap Authors
 * Licensed under the Creative Commons Attribution 3.0 Unported License.
 */

(() => {
  'use strict'

  const getStoredTheme = () => localStorage.getItem('theme')
  const setStoredTheme = theme => localStorage.setItem('theme', theme)

  const getPreferredTheme = () => {
    const storedTheme = getStoredTheme()
    if (storedTheme) {
      return storedTheme
    }

    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
  }

  const setTheme = theme => {
    if (theme === 'auto') {
      document.documentElement.setAttribute('data-bs-theme', (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'))
    } else {
      document.documentElement.setAttribute('data-bs-theme', theme)
    }
  }

  setTheme(getPreferredTheme())

  const showActiveTheme = (theme, focus = false) => {
    const themeSwitcher = document.querySelector('#bd-theme')

    if (!themeSwitcher) {
      return
    }

    const themeSwitcherText = document.querySelector('#bd-theme-text')
    const activeThemeIcon = document.querySelector('.theme-icon-active use')
    const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
    const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')

    document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
      element.classList.remove('active')
      element.setAttribute('aria-pressed', 'false')
    })

    btnToActive.classList.add('active')
    btnToActive.setAttribute('aria-pressed', 'true')
    activeThemeIcon.setAttribute('href', svgOfActiveBtn)
    const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
    themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

    if (focus) {
      themeSwitcher.focus()
    }
  }

  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
    const storedTheme = getStoredTheme()
    if (storedTheme !== 'light' && storedTheme !== 'dark') {
      setTheme(getPreferredTheme())
    }
  })

  window.addEventListener('DOMContentLoaded', () => {
    showActiveTheme(getPreferredTheme())

    document.querySelectorAll('[data-bs-theme-value]')
      .forEach(toggle => {
        toggle.addEventListener('click', () => {
          const theme = toggle.getAttribute('data-bs-theme-value')
          setStoredTheme(theme)
          setTheme(theme)
          showActiveTheme(theme, true)
        })
      })
  })
})()

// 监听滚动条事件
window.onscroll = function() {
    Limg();
};

// 页面加载时调用一次，使图片显示
window.onload = function() {
    var img = document.querySelectorAll("img[data-src]");
    for (var i = 0; i < img.length; i++) {
        img[i].style.opacity = "0";
    }
    Limg();
};

function Limg() {
    var viewHeight = document.documentElement.clientHeight; // 可视区域的高度
    var t = document.documentElement.scrollTop || document.body.scrollTop;
    var limg = document.querySelectorAll("img[data-src]");
    // Array.prototype.forEach.call()是一种快速的方法访问 forEach，并将空数组的 this 换成想要遍历的 list
    Array.prototype.forEach.call(limg, function(item, index) {
        var rect;
        if (item.getAttribute("data-src") === "")
            return;
        // getBoundingClientRect 用于获取某个元素相对于视窗的位置集合。集合中有 top, right, bottom, left 等属性。
        rect = item.getBoundingClientRect();
        // 图片一进入可视区，动态加载
        if (rect.bottom >= 0 && rect.top < viewHeight) {
            (function() {
                var img = new Image();
                img.src = item.getAttribute("data-src");
                item.src = img.src;
                // 给图片添加过渡效果，让图片显示
                var j = 0;
                var intervalId = setInterval(function() {
                    j += 0.2;
                    if (j <= 1) {
                        item.style.opacity = j;
                        return;
                    } else {
                        clearInterval(intervalId);
                    }
                }, 100);
                item.removeAttribute('data-src');
            })();
        }
    });
}


var codeblocks = document.getElementsByTagName("pre")
//循环每个pre代码块，并添加 复制代码
for (var i = 0; i < codeblocks.length; i++) {
    //显示 复制代码 按钮
    currentCode = codeblocks[i]
    currentCode.style = "position: relative;"
    var copy = document.createElement("div")
    copy.style = "position: absolute;right: 4px;\
    top: 4px;background-color: white;padding: 2px 8px;\
    margin: 8px;border-radius: 4px;cursor: pointer;\
    z-index: 9999;\
    box-shadow: 0 2px 4px rgba(0,0,0,0.05), 0 2px 4px rgba(0,0,0,0.05);"
    copy.innerHTML = "复制"
    currentCode.appendChild(copy)
    //让所有 "复制"按钮 全部隐藏
    copy.style.visibility = "hidden"
}

for (var i = 0; i < codeblocks.length; i++) {
    !function (i) {
        //鼠标移到代码块，就显示按钮
        codeblocks[i].onmouseover = function () {
            codeblocks[i].childNodes[1].style.visibility = "visible"
        }

        //执行 复制代码 功能
        function copyArticle(event) {
            const range = document.createRange();

            //范围是 code，不包括刚才创建的div
            range.selectNode(codeblocks[i].childNodes[0]);

            const selection = window.getSelection();
            if (selection.rangeCount > 0) selection.removeAllRanges();
            selection.addRange(range);
            document.execCommand('copy');

            codeblocks[i].childNodes[1].innerHTML = "复制成功"
            setTimeout(function () {
                codeblocks[i].childNodes[1].innerHTML = "复制"
            }, 1000);
            //清除选择区
            if (selection.rangeCount > 0) selection.removeAllRanges(); 0
        }
        codeblocks[i].childNodes[1].addEventListener('click', copyArticle, false);

    }(i);

    !function (i) {
        //鼠标从代码块移开 则不显示复制代码按钮
        codeblocks[i].onmouseout = function () {
            codeblocks[i].childNodes[1].style.visibility = "hidden"
        }
    }(i);
}