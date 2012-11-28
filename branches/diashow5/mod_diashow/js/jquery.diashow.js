(function (a) {
    a.fn.extend({
        diaShow: function (c) {
            var g = {
                imgObject: [],
                containerWidth: "300px",
                containerHeight: "288px",
                containerBorder: "2px solid yellow",
                timerInterval: 3000,
                hintHeight: "20px",
                showFullImage: {
                    showIt: true,
                    xPos: "300px",
                    yPos: "300px",
                    height: "200px",
                    width: "200px",
                    borderCss: "1px solid red;"
                }
            };
            c = a.extend({}, g, c);
            var b = "";
            var f = "";
            var e = 0;
            var h, j;
            var d;
            return this.each(function () {
                var k = c.imgObject;
                var m = "";
                var r = c.containerWidth;
                var v = c.containerHeight;
                var i = c.containerBorder;
                var p = c.timerInterval;
                var s = c.showFullImage;
                var o = c.hintHeight;
                var u = function () {
                    for (d = 0; d < k.length; d++) {
                        m += '<img src="' + k[d].imgName + '" id="image' + d + '" class="ds_image" width="' + r + '" height="' + v + '" />';
                        if (k[d].imgLink !== null && k[d].imgText !== null) {
                            f += '<div class="ds_hint" id="hint' + d + '"><a href="' + k[d].imgLink + '" target="' + k[d].imgTarget + '" class="ds_href"><span class="ds_text">' + k[d].imgText + "</span></a></div>"
                        } else {
                            if (k[d].imgLink === null && k[d].imgText !== null) {
                                f += '<div class="ds_hint" id="hint' + d + '"><span class="ds_text">' + k[d].imgText + "</span></div>"
                            } else {
                                f += '<div class="ds_hint_hidden" style="height: 0px;" id="hint_hidden"></div>'
                            }
                        }
                    }
                    a("#ds_container").css({
                        width: r,
                        height: v,
                        border: i
                    }).append(m).append(f);
                    h = a(".ds_image").get();
                    j = a("div[id^=hint]").get()
                };
                var q = function () {
                    a(".ds_image").css({
                        position: "absolute",
                        opacity: 0,
                        top: "0px",
                        left: "0px"
                    });
                    a("#image0").css({
                        position: "absolute",
                        opacity: 1,
                        top: "0px",
                        left: "0px"
                    })
                };
                var n = function () {
                    a(".ds_hint").css({
                        position: "relative",
                        opacity: 0,
                        top: "0px",
                        left: "0px"
                    });
                    a("#hint0").css({
                        position: "relative",
                        opacity: 0.5,
                        top: "0px",
                        left: "0px",
                        "z-index": 1,
                        height: o
                    })
                };
                var l = function (w) {
                    if (h.length === 1) {
                        return
                    }
                    e = w;
                    a("#ds_container").everyTime(p, "dsShow", function (x) {
                        if (e == (h.length - 1)) {
                            e = 0;
                            a(h[(h.length - 1)]).animate({
                                opacity: 0
                            }, p);
                            a(h[e]).animate({
                                opacity: 1
                            }, p);
                            a(j[(h.length - 1)]).animate({
                                height: "0px",
                                opacity: 0
                            }, p / 2);
                            a(j[e]).animate({
                                height: o,
                                opacity: 0.5
                            }, p / 2)
                        } else {
                            a(h[e]).animate({
                                opacity: 0
                            }, p).next().animate({
                                opacity: 1
                            }, p);
                            a(j[e]).animate({
                                height: "0px",
                                opacity: 0
                            }, p / 2).next().animate({
                                height: o,
                                opacity: 0.5
                            }, p / 2);
                            e++
                        }
                    })
                };
                var t = function () {
                    xOffset = 10;
                    yOffset = 20;
                    a("#ds_container").hover(function (w) {
                        this.t = this.title;
                        this.title = "";
                        a("body").append("<p id='tooltip'>" + this.t + "</p>");
                        a("#tooltip").css("top", (w.pageY - xOffset) + "px").css("left", (w.pageX + yOffset) + "px").fadeIn("fast")
                    }, function () {
                        this.title = this.t;
                        a("#tooltip").remove()
                    });
                    a("a.tooltip").mousemove(function (w) {
                        a("#tooltip").css("top", (w.pageY - xOffset) + "px").css("left", (w.pageX + yOffset) + "px")
                    })
                };
                u();
                q();
                n();
                l(0);
                t();
                a("#ds_container").mouseover(function () {
                    a("#ds_container").stopTime("dsShow");
                    if (s.showIt) {			
                        a(this).bind("mousewheel", function (w, x) {
                            if (x > 0) { 				
                                a("#ds_fullView").empty().append('<img src="' + a(h[e]).attr("src") + '">').css({
                                    left: s.xPos,
                                    top: s.yPos,
                                    width: s.width,
                                    height: s.height,
                                    opacity: 1,
                                    padding: "0px",
                                    margin: "0px",
                                    border: s.borderCss,
                                    "z-index": 1
                                }).show().mouseleave(function () {
                                    a("#ds_fullView").css({
                                        opacity: 0
                                    }).empty()
                                })
                            } else {
                                a("#ds_fullView").css({
                                    opacity: 0
                                }).empty()
                            }
                            return false
                        })
                    }
                });
                a("#ds_container").mouseout(function () {
                    if (s.showIt) {
                        a("#ds_fullView").css({
                            opacity: 0
                        }).empty()
                    }
                    l(e)
                })
            })
        }
    })
})(jQuery);