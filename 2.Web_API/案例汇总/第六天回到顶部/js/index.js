window.onload = function () {
    //给window绑定滚动事件
    var bodyTop = document.getElementById("top");//获取头部
    var toTop = document.getElementById("totop");//获取回到顶部按钮
    var timerId = null;
    window.onscroll = function () {
        //处理获取滚动出去的距离 兼容性
        var scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
        if (scrollTop > 10) {
            bodyTop.className = "header fixed";
            toTop.style.display = "block";
        } else {
            bodyTop.className = "header";
            toTop.style.display = "none";
        }

        toTop.onclick = function () {
            //先清除一遍定时器
            clearInterval(timerId);
            //盒子的距离 = 盒子现在的距离 + 步长
            timerId = setInterval(function () {
                var scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
                var current = scrollTop;
                var step = 10;
                var target = 0;//目标位置 回到定点的话, 是 0
                step = current > target ? -step : step;
                if (Math.abs(current - target) >= Math.abs(step)) {
                    document.documentElement.scrollTop = current + step;
                }else {
                    document.documentElement.scrollTop = 0;
                    clearInterval(timerId);//清除定时器
                }
            }, 15)
        }

    }
}