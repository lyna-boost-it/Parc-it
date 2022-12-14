$(".dial1").knob(),
    $({ animatedVal: 0 }).animate({
        duration: 3e3,
        easing: "swing",
        step: function () {
            $(".dial1").val(Math.ceil(this.animatedVal)).trigger("change");
        },
    }),
    $(".dial2").knob(),
    $({ animatedVal: 0 }).animate({
        duration: 3e3,
        easing: "swing",
        step: function () {
            $(".dial2").val(Math.ceil(this.animatedVal)).trigger("change");
        },
    }),
    $(".dial3").knob(),
    $({ animatedVal: 0 }).animate({
        duration: 3e3,
        easing: "swing",
        step: function () {
            $(".dial3").val(Math.ceil(this.animatedVal)).trigger("change");
        },
    }),
    $(".dial4").knob(),
    $({ animatedVal: 0 }).animate({
        duration: 3e3,
        easing: "swing",
        step: function () {
            $(".dial4").val(Math.ceil(this.animatedVal)).trigger("change");
        },
    }),
    jQuery("#browservisit").vectorMap({
        map: "world_mill_en",
        backgroundColor: "#fff",
        borderWidth: 1,
        zoomOnScroll: !1,
        color: "#ddd",
        regionStyle: { initial: { fill: "#fff" } },
        enableZoom: !0,
        normalizeFunction: "linear",
        showTooltip: !0,
    });
var repair_staff = parseInt($("#repair_staff").val()),
    vehicules = parseInt($("#vehicules").val()),
    unit = parseInt($("#unit").val());
Highcharts.chart("chart", {
    chart: { type: "bar" },
    title: { text: "" },
    yAxis: {
        labels: {
            formatter: function () {
                return this.value;
            },
            style: { color: "#1b00ff", fontSize: "14px" },
        },
        title: { text: "" },
    },
    xAxis: { categories: [" v\xe9hicule", "personne", "unit\xe9"], labels: { style: { color: "#000", fontSize: "18px" } } },
    series: [
        { name: "V\xe9hicule", color: "#00789c", data: [vehicules, 0, 0] },
        { name: "Personne", color: "#236adc", data: [0, repair_staff, 0] },
        { name: "Unit\xe9", color: "#ff686b", data: [0, 0, unit] },
    ],
});
var minibus = parseInt($("#minibus").val()),
    mini_fourgonnettes = parseInt($("#mini_fourgonnettes").val()),
    pick_up = parseInt($("#pick_up").val()),
    total = parseInt($("#total").val());
function cardData() {
    return {
        countUp: function (t, e, a, n, i) {
            let o = new CountUp(t, e || 0, a, n || total, i || 2);
            o.start();
        },
        sessions: [
            { label: "Pick-up", size: pick_up, color: "indigo-600" },
            { label: "Mini-fourgonnettes", size: mini_fourgonnettes, color: "indigo-400" },
            { label: "Minibus", size: minibus, color: "indigo-200" },
        ],
    };
}
$(".value").each(function () {
    var t = $(this).text();
    $(this).parent().css("width", t);
}),
    $(".block").tooltip(),
    $(function () {
        $("#doughnutChart").drawDoughnutChart([
            { title: "Tokyo", value: 120, color: "#2C3E50" },
            { title: "San Francisco", value: 80, color: "#FC4349" },
            { title: "New York", value: 70, color: "#6DBCDB" },
            { title: "London", value: 50, color: "#F7E248" },
            { title: "Sydney", value: 40, color: "#D7DADB" },
            { title: "Berlin", value: 20, color: "#FFF" },
        ]);
    }),
    (function (t, e) {
        t.fn.drawDoughnutChart = function (e, a) {
            var n,
                i,
                o,
                r,
                l = this,
                s = l.width(),
                u = l.height(),
                c = s / 2,
                m = u / 2,
                p = Math.cos,
                f = Math.sin,
                d = Math.PI,
                g = t.extend(
                    {
                        segmentShowStroke: !0,
                        segmentStrokeColor: "#0C1013",
                        segmentStrokeWidth: 1,
                        baseColor: "rgba(0,0,0,0.5)",
                        baseOffset: 4,
                        edgeOffset: 10,
                        percentageInnerCutout: 75,
                        animation: !0,
                        animationSteps: 90,
                        animationEasing: "easeInOutExpo",
                        animateRotate: !0,
                        tipOffsetX: -8,
                        tipOffsetY: -45,
                        tipClass: "doughnutTip",
                        summaryClass: "doughnutSummary",
                        summaryTitle: "TOTAL:",
                        summaryTitleClass: "doughnutSummaryTitle",
                        summaryNumberClass: "doughnutSummaryNumber",
                        beforeDraw: function () {},
                        afterDrawed: function () {},
                        onPathEnter: function (t, e) {},
                        onPathLeave: function (t, e) {},
                    },
                    a
                ),
                h =
                    window.requestAnimationFrame ||
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame ||
                    window.oRequestAnimationFrame ||
                    window.msRequestAnimationFrame ||
                    function (t) {
                        window.setTimeout(t, 1e3 / 60);
                    };
            g.beforeDraw.call(l);
            var v = t('<svg width="' + s + '" height="' + u + '" viewBox="0 0 ' + s + " " + u + '" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"></svg>').appendTo(l),
                w = [],
                _ = {
                    linear: function (t) {
                        return t;
                    },
                    easeInOutExpo: function (t) {
                        var e = t < 0.5 ? 8 * t * t * t * t : 1 - 8 * --t * t * t * t;
                        return e > 1 ? 1 : e;
                    },
                }[g.animationEasing],
                b = ((r = [u / 2, s / 2]), Math.min.apply(null, r) - g.edgeOffset),
                y = b * (g.percentageInnerCutout / 100),
                x = 0,
                k = b + g.baseOffset,
                C = y - g.baseOffset;
            t(document.createElementNS("http://www.w3.org/2000/svg", "path"))
                .attr({ d: V(k, C), fill: g.baseColor })
                .appendTo(v);
            var S = t(document.createElementNS("http://www.w3.org/2000/svg", "g"));
            S.attr({ opacity: 0 }).appendTo(v);
            var T = t('<div class="' + g.tipClass + '" />')
                .appendTo("body")
                .hide();
            T.width(), T.height();
            var A = (y - (b - y)) * 2,
                F = t('<div class="' + g.summaryClass + '" />')
                    .appendTo(l)
                    .css({ width: A + "px", height: A + "px", "margin-left": -(A / 2) + "px", "margin-top": -(A / 2) + "px" });
            t('<p class="' + g.summaryTitleClass + '">' + g.summaryTitle + "</p>").appendTo(F);
            for (
                var O = t('<p class="' + g.summaryNumberClass + '"></p>')
                        .appendTo(F)
                        .css({ opacity: 0 }),
                    D = 0,
                    E = e.length;
                D < E;
                D++
            )
                (x += e[D].value),
                    (w[D] = t(document.createElementNS("http://www.w3.org/2000/svg", "path"))
                        .attr({ "stroke-width": g.segmentStrokeWidth, stroke: g.segmentStrokeColor, fill: e[D].color, "data-order": D })
                        .appendTo(S)
                        .on("mouseenter", z)
                        .on("mouseleave", M)
                        .on("mousemove", N));
            function V(t, e) {
                var a = -1.57,
                    n = 4.7131,
                    i = c + p(a) * t,
                    o = m + f(a) * t,
                    r = c + p(a) * e,
                    l = m + f(a) * e,
                    s = c + p(n) * t,
                    u = m + f(n) * t,
                    d = c + p(n) * e,
                    g = m + f(n) * e,
                    h = ["M", i, o, "A", t, t, 0, 1, 1, s, u, "Z", "M", d, g, "A", e, e, 0, 1, 0, r, l, "Z"];
                return h.join(" ");
            }
            function z(a) {
                var n = t(this).data().order;
                T.text(e[n].title + ": " + e[n].value).fadeIn(200), g.onPathEnter.apply(t(this), [a, e]);
            }
            function M(a) {
                T.hide(), g.onPathLeave.apply(t(this), [a, e]);
            }
            function N(t) {
                T.css({ top: t.pageY + g.tipOffsetY, left: t.pageX - T.width() / 2 + g.tipOffsetX });
            }
            function P(t) {
                return Math.max.apply(null, t);
            }
            function I(t) {
                return !isNaN(parseFloat(t)) && isFinite(t);
            }
            function L(t, e, a) {
                return I(e) && t > e ? e : I(a) && t < a ? a : t;
            }
            return (
                (n = function t(a) {
                    var n = -d / 2,
                        i = 1;
                    if (
                        (g.animation && g.animateRotate && (i = a),
                        (function t(e, a) {
                            O.css({ opacity: e }).text((a * e).toFixed(1));
                        })(a, x),
                        S.attr("opacity", a),
                        1 === e.length && 4.7122 < i * ((e[0].value / x) * (2 * d)) + n)
                    ) {
                        w[0].attr("d", V(b, y));
                        return;
                    }
                    for (var o = 0, r = e.length; o < r; o++) {
                        var l = i * ((e[o].value / x) * (2 * d)),
                            s = n + l,
                            u = (s - n) % (2 * d) > d ? 1 : 0,
                            h = c + p(n) * b,
                            v = m + f(n) * b,
                            _ = c + p(n) * y,
                            k = m + f(n) * y,
                            C = c + p(s) * b,
                            T = m + f(s) * b,
                            A = c + p(s) * y,
                            F = m + f(s) * y,
                            D = ["M", h, v, "A", b, b, 0, u, 1, C, T, "L", A, F, "A", y, y, 0, u, 0, _, k, "Z"];
                        w[o].attr("d", D.join(" ")), (n += l);
                    }
                }),
                (i = g.animation ? 1 / L(g.animationSteps, Number.MAX_VALUE, 1) : 1),
                (o = g.animation ? 0 : 1),
                h(function () {
                    var t, e;
                    (o += i), (t = o), (e = n)(g.animation ? L(_(t), null, 0) : 1), o <= 1 ? h(arguments.callee) : g.afterDrawed.call(l);
                }),
                l
            );
        };
    })(jQuery);
