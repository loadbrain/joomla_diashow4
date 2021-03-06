(function(e) {
    e.fn.extend({
        diaShow: function(t) {
            var n = {
                imgObject: [],
                containerWidth: "300px",
                containerHeight: "288px",
                containerBorder: "2px solid yellow",
                timerInterval: 3e3,
                hintHeight: "20px",
                showFullImage: {
                    showIt: true,
                    xPos: "300px",
                    yPos: "300px",
                    height: "auto",
                    width: "auto",
                    borderCss: "1px solid red;"
                }
            };
            t = e.extend({}, n, t);
            var r = "";
            var i = "";
            var s = 0;
            var o, u;
            var f;
            return this.each(function() {
                var n = t.imgObject;
                var r = "";
                var l = t.containerWidth;
                var p = t.containerHeight;
                var v = t.containerBorder;
                var m = t.timerInterval;
                var g = t.showFullImage;
                var y = t.hintHeight;
                var b = function() {
                    for (f = 0; f < n.length; f++) {
                        r += '<img src="' + n[f].imgName + '" id="image' + f + '" class="ds_image" width="' + l + '" height="' + p + '" />';
                        if (n[f].imgLink !== null && n[f].imgText !== null) {
                            i += '<div class="ds_hint" id="hint' + f + '"><a href="' + n[f].imgLink + '" target="' + n[f].imgTarget + '" class="ds_href"><span class="ds_text">' + n[f].imgText + "</span></a></div>"
                        } else {
                            if (n[f].imgLink === null && n[f].imgText !== null) {
                                i += '<div class="ds_hint" id="hint' + f + '"><span class="ds_text">' + n[f].imgText + "</span></div>"
                            } else {
                                i += '<div class="ds_hint_hidden" style="height: 0px;" id="hint_hidden"></div>'
                            }
                        }
                    }
                    e("#ds_container").css({
                        width: l,
                        height: p,
                        border: v
                    }).append(r).append(i);
                    o = e(".ds_image").get();
                    u = e("div[id^=hint]").get()
                };
                var w = function() {
                    e(".ds_image").css({
                        position: "absolute",
                        opacity: 0,
                        top: "0px",
                        left: "0px"
                    });
                    e("#image0").css({
                        position: "absolute",
                        opacity: 1,
                        top: "0px",
                        left: "0px"
                    })
                };
                var E = function() {
                    e(".ds_hint").css({
                        position: "relative",
                        opacity: 0,
                        top: "0px",
                        left: "0px"
                    });
                    e("#hint0").css({
                        position: "relative",
                        opacity: .5,
                        top: "0px",
                        left: "0px",
                        "z-index": 1,
                        height: y
                    })
                };
                var S = function(t) {
                    if (o.length === 1) {
                        return
                    }
                    s = t;
                    e("#ds_container").everyTime(m, "dsShow", function(t) {
                        if (s == o.length - 1) {
                            s = 0;
                            e(o[o.length - 1]).animate({
                                opacity: 0
                            }, m);
                            e(o[s]).animate({
                                opacity: 1
                            }, m);
                            e(u[o.length - 1]).animate({
                                height: "0px",
                                opacity: 0
                            }, m / 2);
                            e(u[s]).animate({
                                height: y,
                                opacity: .5
                            }, m / 2)
                        } else {
                            e(o[s]).animate({
                                opacity: 0
                            }, m).next().animate({
                                opacity: 1
                            }, m);
                            e(u[s]).animate({
                                height: "0px",
                                opacity: 0
                            }, m / 2).next().animate({
                                height: y,
                                opacity: .5
                            }, m / 2);
                            s++
                        }
                    })
                };
                var x = function() {
                    xOffset = 10;
                    yOffset = 20;
                    e("#ds_container").hover(function(t) {
                        this.t = this.title;
                        this.title = "";
                        e("body").append("<p id='tooltip'>" + this.t + "</p>");
                        e("#tooltip").css("top", t.pageY - xOffset + "px").css("left", t.pageX + yOffset + "px").fadeIn("fast")
                    }, function() {
                        this.title = this.t;
                        e("#tooltip").remove()
                    });
                    e("a.tooltip").mousemove(function(t) {
                        e("#tooltip").css("top", t.pageY - xOffset + "px").css("left", t.pageX + yOffset + "px")
                    })
                };
                b();
                w();
                E();
                S(0);
                x();
                e("#ds_container").mouseover(function() {
                    e("#ds_container").stopTime("dsShow");
                    if (g.showIt) {
                        e(this).bind("mousewheel", function(n, r) {
                            if (r > 0) {
                                e("#ds_fullView").empty().append('<img src="' + e(o[s]).attr("src") + '" width="' + t.showFullImage.width + '" height="' + t.showFullImage.height + '">').css({
                                    left: g.xPos,
                                    top: g.yPos,
                                    width: t.showFullImage.width,
                                    height: t.showFullImage.height,
                                    opacity: 1,
                                    padding: "0px",
                                    margin: "0px",
                                    border: g.borderCss,
                                    "z-index": 1
                                }).show().mouseleave(function() {
                                    e("#ds_fullView").css({
                                        opacity: 0
                                    }).empty()
                                })
                            } else {
                                e("#ds_fullView").css({
                                    opacity: 0
                                }).empty()
                            }
                            return false
                        })
                    }
                });
                e("#ds_container").mouseout(function() {
                    if (g.showIt) {
                        e("#ds_fullView").css({
                            opacity: 0
                        }).empty()
                    }
                    S(s)
                })
            })
        }
    })
})(jQuery)
