!(function (x, y) {
    "use strict";
    y.WPAccordionSlider = {
        modules: {},
        addModule: function (x, z, f) {
            "undefined" == typeof this.modules[f] && (this.modules[f] = []), this.modules[f].push(x), "accordion" === f ? y.extend(d.prototype, z) : "panel" === f && y.extend(e.prototype, z);
        },
    };
    var z = (y.WPAccordionSlider.namespace = "WPAccordionSlider"),
        d = function (x, z) {
            (this.$accordion = y(x)),
                (this.$panelsContainer = null),
                (this.$maskContainer = null),
                (this.options = z),
                (this.settings = {}),
                (this.originalSettings = {}),
                (this.currentIndex = -1),
                (this.currentPage = 0),
                (this.totalSize = 0),
                (this.totalPanelsSize = 0),
                (this.computedOpenedPanelSize = 0),
                (this.maxComputedOpenedPanelSize = 0),
                (this.collapsedPanelSize = 0),
                (this.closedPanelSize = 0),
                (this.computedPanelDistance = 0),
                (this.panels = []),
                (this.mouseDelayTimer = 0),
                (this.openPanelAnimation = {}),
                (this.closePanelsAnimation = {}),
                (this.uniqueId = new Date().valueOf()),
                (this.breakpoints = []),
                (this.currentBreakpoint = -1),
                (this.previousVisiblePanels = -1),
                (this.isPageScrolling = !1),
                (this.positionProperty = "left"),
                (this.sizeProperty = "width"),
                (this.autoResponsiveRatio = 1),
                (this.isOverlapping = !1),
                this._init();
        };
    d.prototype = {
        _init: function () {
            var d = this;
            this.$accordion.removeClass("as-no-js"),
                (this.$maskContainer = y('<div class="as-mask"></div>').appendTo(this.$accordion)),
                (this.$panelsContainer = this.$accordion.find(".as-panels").appendTo(this.$maskContainer)),
                0 === this.$panelsContainer.length && (this.$panelsContainer = y('<div class="as-panels"></div>').appendTo(this.$maskContainer));
            var e = y.WPAccordionSlider.modules.accordion;
            if ("undefined" != typeof e)
                for (var f = 0; f < e.length; f++) {
                    var g = e[f] + "Defaults";
                    "undefined" != typeof this[g] ? y.extend(this.defaults, this[g]) : ((g = e[f].substring(0, 1).toLowerCase() + e[f].substring(1) + "Defaults"), "undefined" != typeof this[g] && y.extend(this.defaults, this[g]));
                }
            if (((this.settings = y.extend({}, this.defaults, this.options)), "undefined" != typeof e)) for (var h = 0; h < e.length; h++) "undefined" != typeof this["init" + e[h]] && this["init" + e[h]]();
            if (((this.originalSettings = y.extend({}, this.settings)), this.settings.shuffle === !0)) {
                var i = this.$panelsContainer.find(".as-panel").sort(function () {
                    return 0.5 - Math.random();
                });
                this.$panelsContainer.empty().append(i);
            }
            if (
                ((this.currentIndex = this.settings.startPanel),
                -1 === this.currentIndex ? this.$accordion.addClass("as-closed") : this.$accordion.addClass("as-opened"),
                -1 !== this.settings.startPage && (this.currentPage = this.settings.startPage),
                null !== this.settings.breakpoints)
            ) {
                for (var j in this.settings.breakpoints) this.breakpoints.push({ size: parseInt(j, 10), properties: this.settings.breakpoints[j] });
                this.breakpoints = this.breakpoints.sort(function (x, y) {
                    return x.size >= y.size ? 1 : -1;
                });
            }
            if ((this._prepareRAF(), this.update(), -1 !== this.currentIndex)) {
                this.$accordion.find(".as-panel").eq(this.currentIndex).addClass("as-opened");
                var k = { type: "panelOpen", index: this.currentIndex, previousIndex: -1 };
                this.trigger(k), y.isFunction(this.settings.panelOpen) && this.settings.panelOpen.call(this, k);
            }
            this.on("mouseenter." + z, function (x) {
                var z = { type: "accordionMouseOver" };
                d.trigger(z), y.isFunction(d.settings.accordionMouseOver) && d.settings.accordionMouseOver.call(d, z);
            }),
                this.on("mouseleave." + z, function (x) {
                    clearTimeout(d.mouseDelayTimer), d.settings.closePanelsOnMouseOut === !0 && d.closePanels();
                    var z = { type: "accordionMouseOut" };
                    d.trigger(z), y.isFunction(d.settings.accordionMouseOut) && d.settings.accordionMouseOut.call(d, z);
                }),
                y(x).on("resize." + this.uniqueId + "." + z, function () {
                    d.resize();
                }),
                this.trigger({ type: "init" }),
                y.isFunction(this.settings.init) && this.settings.init.call(this, { type: "init" });
        },
        update: function () {
            var x = this;
            if (
                ("horizontal" === this.settings.orientation
                    ? (this.$accordion.removeClass("as-vertical").addClass("as-horizontal"), (this.positionProperty = "left"), (this.sizeProperty = "width"))
                    : "vertical" === this.settings.orientation && (this.$accordion.removeClass("as-horizontal").addClass("as-vertical"), (this.positionProperty = "top"), (this.sizeProperty = "height")),
                -1 === this.settings.visiblePanels)
            )
                this.currentPage = 0;
            else if (-1 !== this.currentIndex) this.currentPage = Math.floor(this.currentIndex / this.settings.visiblePanels);
            else if (this.settings.visiblePanels !== this.previousVisiblePanels && -1 !== this.previousVisiblePanels) {
                var z = Math.round((this.currentPage * this.previousVisiblePanels) / this.settings.visiblePanels);
                this.currentPage !== z && (this.currentPage = z);
            }
            this.settings.panelDistance > 0 || this.settings.panelOverlap === !1
                ? ((this.isOverlapping = !1), this.$accordion.removeClass("as-overlap"))
                : this.settings.panelOverlap === !0 && ((this.isOverlapping = !0), this.$accordion.addClass("as-overlap")),
                this.$accordion.find("img.as-background, img.as-background-opened").css({ width: "", height: "" }),
                this._updatePanels(),
                this._updatePaginationButtons(),
                this.settings.shadow === !0 ? this.$accordion.find(".as-panel").addClass("as-shadow") : this.settings.shadow === !1 && this.$accordion.find(".as-shadow").removeClass("as-shadow"),
                this.$panelsContainer.attr("style", ""),
                this.resize();
            var d = { type: "update" };
            x.trigger(d), y.isFunction(x.settings.update) && x.settings.update.call(x, d);
        },
        _updatePanels: function () {
            for (var x = this, d = this.panels.length - 1; d >= 0; d--)
                if (0 === this.$accordion.find('.as-panel[data-index="' + d + '"]').length) {
                    var e = this.panels[d];
                    e.off("panelMouseOver." + z), e.off("panelMouseOut." + z), e.off("panelClick." + z), e.off("imagesComplete." + z), e.destroy(), this.panels.splice(d, 1);
                }
            this.$accordion.find(".as-panel").each(function (z, d) {
                var e = y(d);
                "undefined" == typeof e.attr("data-init") ? x._createPanel(z, e) : (x.panels[z].setIndex(z), x.panels[z].update());
            });
        },
        _createPanel: function (x, d) {
            var f = this,
                g = y(d),
                h = new e(g, this, x);
            this.panels.splice(x, 0, h),
                h.on("panelMouseOver." + z, function (z) {
                    if (f.isPageScrolling !== !0) {
                        "hover" === f.settings.openPanelOn &&
                            (clearTimeout(f.mouseDelayTimer),
                            (f.mouseDelayTimer = setTimeout(function () {
                                f.openPanel(z.index);
                            }, f.settings.mouseDelay)));
                        var d = { type: "panelMouseOver", index: x };
                        f.trigger(d), y.isFunction(f.settings.panelMouseOver) && f.settings.panelMouseOver.call(f, d);
                    }
                }),
                h.on("panelMouseOut." + z, function (z) {
                    if (f.isPageScrolling !== !0) {
                        var d = { type: "panelMouseOut", index: x };
                        f.trigger(d), y.isFunction(f.settings.panelMouseOut) && f.settings.panelMouseOut.call(f, d);
                    }
                }),
                h.on("panelClick." + z, function (z) {
                    if (!f.$accordion.hasClass("as-swiping")) {
                        "click" === f.settings.openPanelOn && (x !== f.currentIndex ? f.openPanel(z.index) : f.closePanels());
                        var d = { type: "panelClick", index: x };
                        f.trigger(d), y.isFunction(f.settings.panelClick) && f.settings.panelClick.call(f, d);
                    }
                }),
                h.on("panelMouseDown." + z, function (z) {
                    y(this).find("a").off("click.disablePanelLink"),
                        x !== f.currentIndex &&
                            "click" === f.settings.openPanelOn &&
                            y(this)
                                .find("a")
                                .one("click.disablePanelLink", function (x) {
                                    x.preventDefault();
                                });
                }),
                h.on("imagesComplete." + z, function (x) {
                    x.index === f.currentIndex && x.contentSize !== f.computedOpenedPanelSize && f.openPanel(x.index, !0);
                });
        },
        removePanels: function () {
            y.each(this.panels, function (x, b) {
                b.off("panelMouseOver." + z), b.off("panelMouseOut." + z), b.off("panelClick." + z), b.off("imagesComplete." + z), b.destroy();
            }),
                (this.panels.length = 0);
        },
        resize: function () {
            var z = this;
            if (
                (this.$maskContainer.attr("style", ""),
                this.settings.responsive === !0
                    ? (this.$accordion.css({ width: "100%", height: this.settings.height, maxWidth: this.settings.width, maxHeight: this.settings.height }),
                      -1 === this.settings.aspectRatio && (this.settings.aspectRatio = this.settings.width / this.settings.height),
                      this.$accordion.css("height", this.$accordion.innerWidth() / this.settings.aspectRatio),
                      "auto" === this.settings.responsiveMode
                          ? ((this.autoResponsiveRatio = this.$accordion.innerWidth() / this.settings.width),
                            this.$maskContainer.css("width", this.settings.width),
                            isNaN(this.settings.height)
                                ? this.$maskContainer.css("height", Math.min(this.settings.width / this.settings.aspectRatio, (parseInt(this.settings.height, 10) / 100) * y(x).height()))
                                : this.$maskContainer.css("height", Math.min(this.settings.width / this.settings.aspectRatio, this.settings.height)),
                            this.autoResponsiveRatio < 1
                                ? this.$maskContainer.css({
                                      "-webkit-transform": "scaleX(" + this.autoResponsiveRatio + ") scaleY(" + this.autoResponsiveRatio + ")",
                                      "-ms-transform": "scaleX(" + this.autoResponsiveRatio + ") scaleY(" + this.autoResponsiveRatio + ")",
                                      transform: "scaleX(" + this.autoResponsiveRatio + ") scaleY(" + this.autoResponsiveRatio + ")",
                                      "-webkit-transform-origin": "top left",
                                      "-ms-transform-origin": "top left",
                                      "transform-origin": "top left",
                                  })
                                : this.$maskContainer.css({ "-webkit-transform": "", "-ms-transform": "", transform: "", "-webkit-transform-origin": "", "-ms-transform-origin": "", "transform-origin": "" }),
                            (this.totalSize = "horizontal" === this.settings.orientation ? this.$maskContainer.innerWidth() : this.$maskContainer.innerHeight()))
                          : (this.totalSize = "horizontal" === this.settings.orientation ? this.$accordion.innerWidth() : this.$accordion.innerHeight()))
                    : (this.$accordion.css({ width: this.settings.width, height: this.settings.height, maxWidth: "", maxHeight: "" }),
                      (this.totalSize = "horizontal" === this.settings.orientation ? this.$accordion.innerWidth() : this.$accordion.innerHeight())),
                "horizontal" === this.settings.orientation
                    ? this.$accordion.find("img.as-background, img.as-background-opened").css("height", this.$panelsContainer.innerHeight())
                    : this.$accordion.find("img.as-background, img.as-background-opened").css("width", this.$panelsContainer.innerWidth()),
                (this.computedPanelDistance = this.settings.panelDistance),
                "string" == typeof this.computedPanelDistance &&
                    (-1 !== this.computedPanelDistance.indexOf("%")
                        ? (this.computedPanelDistance = this.totalSize * (parseInt(this.computedPanelDistance, 10) / 100))
                        : -1 !== this.computedPanelDistance.indexOf("px") && (this.computedPanelDistance = parseInt(this.computedPanelDistance, 10))),
                (this.closedPanelSize = (this.totalSize - (this.getVisiblePanels() - 1) * this.computedPanelDistance) / this.getVisiblePanels()),
                (this.closedPanelSize = Math.floor(this.closedPanelSize)),
                (this.computedOpenedPanelSize = this.settings.openedPanelSize),
                "max" === this.settings.openedPanelSize &&
                    ((this.maxComputedOpenedPanelSize = this.settings.maxOpenedPanelSize),
                    "string" == typeof this.maxComputedOpenedPanelSize &&
                        (-1 !== this.maxComputedOpenedPanelSize.indexOf("%")
                            ? (this.maxComputedOpenedPanelSize = this.totalSize * (parseInt(this.maxComputedOpenedPanelSize, 10) / 100))
                            : -1 !== this.maxComputedOpenedPanelSize.indexOf("px") && (this.maxComputedOpenedPanelSize = parseInt(this.maxComputedOpenedPanelSize, 10)))),
                "string" == typeof this.computedOpenedPanelSize)
            )
                if (-1 !== this.computedOpenedPanelSize.indexOf("%")) this.computedOpenedPanelSize = this.totalSize * (parseInt(this.computedOpenedPanelSize, 10) / 100);
                else if (-1 !== this.computedOpenedPanelSize.indexOf("px")) this.computedOpenedPanelSize = parseInt(this.computedOpenedPanelSize, 10);
                else if ("max" === this.computedOpenedPanelSize && -1 !== this.currentIndex) {
                    var d = this.getPanelAt(this.currentIndex).getContentSize();
                    this.computedOpenedPanelSize = "loading" === d ? this.closedPanelSize : Math.min(d, this.maxComputedOpenedPanelSize);
                }
            if (
                ((this.collapsedPanelSize = (this.totalSize - this.computedOpenedPanelSize - (this.getVisiblePanels() - 1) * this.computedPanelDistance) / (this.getVisiblePanels() - 1)),
                (this.computedOpenedPanelSize = Math.floor(this.computedOpenedPanelSize)),
                (this.collapsedPanelSize = Math.floor(this.collapsedPanelSize)),
                (this.totalPanelsSize = this.closedPanelSize * this.getTotalPanels() + this.computedPanelDistance * (this.getTotalPanels() - 1)),
                this.$panelsContainer.css(this.sizeProperty, this.totalPanelsSize),
                (this.totalSize = this.closedPanelSize * this.getVisiblePanels() + this.computedPanelDistance * (this.getVisiblePanels() - 1)),
                "custom" === this.settings.responsiveMode || this.settings.responsive === !1
                    ? this.$accordion.css(this.sizeProperty, this.totalSize)
                    : (this.$accordion.css(this.sizeProperty, this.totalSize * this.autoResponsiveRatio), this.$maskContainer.css(this.sizeProperty, this.totalSize)),
                -1 !== this.settings.visiblePanels)
            ) {
                var e = {},
                    f = -(this.totalSize + this.computedPanelDistance) * this.currentPage;
                this.currentPage === this.getTotalPages() - 1 && (f = -(this.closedPanelSize * this.getTotalPanels() + this.computedPanelDistance * (this.getTotalPanels() - 1) - this.totalSize)),
                    (e[this.positionProperty] = f),
                    this.$panelsContainer.css(e);
            }
            var g = this.currentPage === this.getTotalPages() - 1 && this.getTotalPanels() % this.settings.visiblePanels !== 0 ? this.settings.visiblePanels - (this.getTotalPanels() % this.settings.visiblePanels) : 0;
            if (
                (y.each(this.panels, function (x, b) {
                    var d;
                    if (
                        (-1 === z.currentIndex
                            ? (d = x * (z.closedPanelSize + z.computedPanelDistance))
                            : -1 === z.settings.visiblePanels
                            ? (d = x * (z.collapsedPanelSize + z.computedPanelDistance) + (x > z.currentIndex ? z.computedOpenedPanelSize - z.collapsedPanelSize : 0))
                            : z._getPageOfPanel(x) === z.currentPage
                            ? ((d =
                                  z.currentPage * (z.totalSize + z.computedPanelDistance) +
                                  (x + g - z.currentPage * z.settings.visiblePanels) * (z.collapsedPanelSize + z.computedPanelDistance) +
                                  (x > z.currentIndex ? z.computedOpenedPanelSize - z.collapsedPanelSize : 0)),
                              z.currentPage === z.getTotalPages() - 1 && 0 !== g && (d -= (z.getTotalPages() - z.getTotalPanels() / z.settings.visiblePanels) * (z.totalSize + z.computedPanelDistance)))
                            : (d = x * (z.closedPanelSize + z.computedPanelDistance)),
                        b.setPosition(d),
                        z.isOverlapping === !1)
                    ) {
                        var e = -1 === z.currentIndex || (-1 !== z.settings.visiblePanels && z._getPageOfPanel(x) !== z.currentPage) ? z.closedPanelSize : x === z.currentIndex ? z.computedOpenedPanelSize : z.collapsedPanelSize;
                        b.setSize(e);
                    }
                }),
                null !== this.settings.breakpoints && this.breakpoints.length > 0)
            )
                if (y(x).width() > this.breakpoints[this.breakpoints.length - 1].size && -1 !== this.currentBreakpoint) (this.currentBreakpoint = -1), this._setProperties(this.originalSettings, !1);
                else
                    for (var h = 0, i = this.breakpoints.length; i > h; h++)
                        if (y(x).width() <= this.breakpoints[h].size) {
                            if (this.currentBreakpoint !== this.breakpoints[h].size) {
                                var j = { type: "breakpointReach", size: this.breakpoints[h].size, settings: this.breakpoints[h].properties };
                                z.trigger(j), y.isFunction(z.settings.breakpointReach) && z.settings.breakpointReach.call(z, j), (this.currentBreakpoint = this.breakpoints[h].size);
                                var k = y.extend({}, this.originalSettings, this.breakpoints[h].properties);
                                this._setProperties(k, !1);
                            }
                            break;
                        }
        },
        _setProperties: function (x, b) {
            for (var z in x) "visiblePanels" === z && -1 !== this.settings.visiblePanels && (this.previousVisiblePanels = this.settings.visiblePanels), (this.settings[z] = x[z]), b !== !1 && (this.originalSettings[z] = x[z]);
            this.update();
        },
        destroy: function () {
            this.$accordion.removeData("WPaccordionSlider"),
                this.$accordion.attr("style", ""),
                this.$panelsContainer.attr("style", ""),
                this.off("mouseenter." + z),
                this.off("mouseleave." + z),
                y(x).off("resize." + this.uniqueId + "." + z),
                this._stopPanelsAnimation(this.openPanelAnimation),
                this._stopPanelsAnimation(this.closePanelsAnimation);
            var d = y.WPAccordionSlider.modules.accordion;
            if ("undefined" != typeof d) for (var e = 0; e < d.length; e++) "undefined" != typeof this["destroy" + d[e]] && this["destroy" + d[e]]();
            this.removePanels(), this.$panelsContainer.appendTo(this.$accordion), this.$maskContainer.remove(), this.$accordion.find(".as-pagination-buttons").remove();
        },
        on: function (x, b) {
            return this.$accordion.on(x, b);
        },
        off: function (x) {
            return this.$accordion.off(x);
        },
        trigger: function (x) {
            return this.$accordion.triggerHandler(x);
        },
        getPanelAt: function (x) {
            return this.panels[x];
        },
        getCurrentIndex: function () {
            return this.currentIndex;
        },
        getTotalPanels: function () {
            return this.panels.length;
        },
        nextPanel: function () {
            var x = this.currentIndex >= this.getTotalPanels() - 1 ? 0 : this.currentIndex + 1;
            this.openPanel(x);
        },
        previousPanel: function () {
            var x = this.currentIndex <= 0 ? this.getTotalPanels() - 1 : this.currentIndex - 1;
            this.openPanel(x);
        },
        _animatePanels: function (b, z) {
            function d() {
                1 > f
                    ? ((f = (new Date().valueOf() - e) / z.duration), f > 1 && (f = 1), (f = 0.5 - Math.cos(f * Math.PI) / 2), z.step(f), (b.timer = x.requestAnimationFrame(d)))
                    : (z.complete(), (b.isRunning = !1), x.cancelAnimationFrame(b.timer));
            }
            var e = new Date().valueOf(),
                f = 0;
            (b.isRunning = !0), (b.timer = x.requestAnimationFrame(d));
        },
        _stopPanelsAnimation: function (b) {
            "undefined" != typeof b.isRunning && b.isRunning === !0 && ((b.isRunning = !1), x.cancelAnimationFrame(b.timer));
        },
        _prepareRAF: function () {
            if ("undefined" == typeof x.requestAnimationFrame)
                for (var y = ["webkit", "moz"], z = 0; z < y.length; z++)
                    (x.requestAnimationFrame = x[y[z] + "RequestAnimationFrame"]), (x.cancelAnimationFrame = x.cancelAnimationFrame || x[y[z] + "CancelAnimationFrame"] || x[y[z] + "CancelRequestAnimationFrame"]);
            if ("undefined" == typeof x.requestAnimationFrame) {
                var d = 0;
                (x.requestAnimationFrame = function (b, z) {
                    var e = new Date().valueOf(),
                        f = Math.max(0, 16 - (e - d)),
                        g = x.setTimeout(function () {
                            b(e + f);
                        }, f);
                    return (d = e + f), g;
                }),
                    (x.cancelAnimationFrame = function (x) {
                        clearTimeout(x);
                    });
            }
        },
        openPanel: function (x, z) {
            if (x !== this.currentIndex || z === !0) {
                this.$accordion.hasClass("as-opened") === !1 && (this.$accordion.removeClass("as-closed"), this.$accordion.addClass("as-opened"));
                var d = this.currentIndex;
                if (((this.currentIndex = x), -1 !== this.settings.visiblePanels && !(this.currentPage === this.getTotalPages() - 1 && x >= this.getTotalPanels() - this.settings.visiblePanels))) {
                    var e = Math.floor(this.currentIndex / this.settings.visiblePanels);
                    e !== this.currentPage && this.gotoPage(e), (this.currentIndex = x);
                }
                var f = this,
                    g = [],
                    h = [],
                    i = [],
                    j = [],
                    k = [],
                    l = this._getFirstPanelFromPage(),
                    m = this._getLastPanelFromPage(),
                    n = 0;
                if ((this.$accordion.find(".as-panel.as-opened").removeClass("as-opened"), this.$accordion.find(".as-panel").eq(this.currentIndex).addClass("as-opened"), "max" === this.settings.openedPanelSize)) {
                    var o = this.getPanelAt(this.currentIndex).getContentSize();
                    (this.computedOpenedPanelSize = "loading" === o ? this.closedPanelSize : Math.min(o, this.maxComputedOpenedPanelSize)),
                        (this.collapsedPanelSize = (this.totalSize - this.computedOpenedPanelSize - (this.getVisiblePanels() - 1) * this.computedPanelDistance) / (this.getVisiblePanels() - 1));
                }
                for (var p = l; m >= p; p++) {
                    var q = this.getPanelAt(p);
                    (j[p] = q.getPosition()),
                        (h[p] =
                            this.currentPage * (this.totalSize + this.computedPanelDistance) +
                            n * (this.collapsedPanelSize + this.computedPanelDistance) +
                            (p > this.currentIndex ? this.computedOpenedPanelSize - this.collapsedPanelSize : 0)),
                        -1 !== this.settings.visiblePanels &&
                            this.currentPage === this.getTotalPages() - 1 &&
                            (h[p] -= (this.getTotalPages() - this.getTotalPanels() / this.settings.visiblePanels) * (this.totalSize + this.computedPanelDistance)),
                        h[p] !== j[p] && k.push(p),
                        this.isOverlapping === !1 && ((i[p] = q.getSize()), (g[p] = p === this.currentIndex ? this.computedOpenedPanelSize : this.collapsedPanelSize), g[p] !== i[p] && -1 === y.inArray(p, k) && k.push(p)),
                        n++;
                }
                var r = k.length;
                this.closePanelsAnimation.page === this.currentPage && this._stopPanelsAnimation(this.closePanelsAnimation),
                    this._stopPanelsAnimation(this.openPanelAnimation),
                    (this.openPanelAnimation.page = this.currentPage),
                    this._animatePanels(this.openPanelAnimation, {
                        duration: this.settings.openPanelDuration,
                        step: function (x) {
                            for (var b = 0; r > b; b++) {
                                var z = k[b],
                                    d = f.getPanelAt(z);
                                d.setPosition(x * (h[z] - j[z]) + j[z]), f.isOverlapping === !1 && d.setSize(x * (g[z] - i[z]) + i[z]);
                            }
                        },
                        complete: function () {
                            var x = { type: "panelOpenComplete", index: f.currentIndex };
                            f.trigger(x), y.isFunction(f.settings.panelOpenComplete) && f.settings.panelOpenComplete.call(f, x);
                        },
                    });
                var s = { type: "panelOpen", index: x, previousIndex: d };
                this.trigger(s), y.isFunction(this.settings.panelOpen) && this.settings.panelOpen.call(this, s);
            }
        },
        closePanels: function () {
            var x = this.currentIndex;
            (this.currentIndex = -1),
                this.$accordion.hasClass("as-closed") === !1 && (this.$accordion.removeClass("as-opened"), this.$accordion.addClass("as-closed")),
                this.$accordion.find(".as-panel.as-opened").removeClass("as-opened"),
                clearTimeout(this.mouseDelayTimer);
            for (var z = this, d = [], e = [], f = [], g = [], h = this._getFirstPanelFromPage(), i = this._getLastPanelFromPage(), j = 0, k = h; i >= k; k++) {
                var l = this.getPanelAt(k);
                (g[k] = l.getPosition()),
                    (e[k] = this.currentPage * (this.totalSize + this.computedPanelDistance) + j * (this.closedPanelSize + this.computedPanelDistance)),
                    -1 !== this.settings.visiblePanels &&
                        this.currentPage === this.getTotalPages() - 1 &&
                        (e[k] -= (this.getTotalPages() - this.getTotalPanels() / this.settings.visiblePanels) * (this.totalSize + this.computedPanelDistance)),
                    this.isOverlapping === !1 && ((f[k] = l.getSize()), (d[k] = this.closedPanelSize)),
                    j++;
            }
            this.openPanelAnimation.page === this.currentPage && this._stopPanelsAnimation(this.openPanelAnimation),
                this._stopPanelsAnimation(this.closePanelsAnimation),
                (this.closePanelsAnimation.page = this.currentPage),
                this._animatePanels(this.closePanelsAnimation, {
                    duration: this.settings.closePanelDuration,
                    step: function (x) {
                        for (var b = h; i >= b; b++) {
                            var j = z.getPanelAt(b);
                            j.setPosition(x * (e[b] - g[b]) + g[b]), z.isOverlapping === !1 && j.setSize(x * (d[b] - f[b]) + f[b]);
                        }
                    },
                    complete: function () {
                        var d = { type: "panelsCloseComplete", previousIndex: x };
                        z.trigger(d), y.isFunction(z.settings.panelsCloseComplete) && z.settings.panelsCloseComplete.call(z, d);
                    },
                });
            var m = { type: "panelsClose", previousIndex: x };
            this.trigger(m), y.isFunction(this.settings.panelsClose) && this.settings.panelsClose.call(this, m);
        },
        getVisiblePanels: function () {
            return -1 === this.settings.visiblePanels ? this.getTotalPanels() : this.settings.visiblePanels;
        },
        getTotalPages: function () {
            return -1 === this.settings.visiblePanels ? 1 : Math.ceil(this.getTotalPanels() / this.settings.visiblePanels);
        },
        getCurrentPage: function () {
            return -1 === this.settings.visiblePanels ? 0 : this.currentPage;
        },
        gotoPage: function (x) {
            -1 !== this.currentIndex && this.closePanels(), (this.currentPage = x), (this.isPageScrolling = !0);
            var z = this,
                d = {},
                e = -(x * this.totalSize + this.currentPage * this.computedPanelDistance);
            this.currentPage === this.getTotalPages() - 1 && (e = -(this.totalPanelsSize - this.totalSize)), (d[this.positionProperty] = e);
            var f = { type: "pageScroll", index: this.currentPage };
            this.trigger(f),
                y.isFunction(this.settings.pageScroll) && this.settings.pageScroll.call(this, f),
                this.$panelsContainer.stop().animate(d, this.settings.pageScrollDuration, this.settings.pageScrollEasing, function () {
                    z.isPageScrolling = !1;
                    var x = { type: "pageScrollComplete", index: z.currentPage };
                    z.trigger(x), y.isFunction(z.settings.pageScrollComplete) && z.settings.pageScrollComplete.call(z, x);
                });
        },
        nextPage: function () {
            var x = this.currentPage >= this.getTotalPages() - 1 ? 0 : this.currentPage + 1;
            this.gotoPage(x);
        },
        previousPage: function () {
            var x = this.currentPage <= 0 ? this.getTotalPages() - 1 : this.currentPage - 1;
            this.gotoPage(x);
        },
        _getFirstPanelFromPage: function () {
            return -1 === this.settings.visiblePanels ? 0 : this.currentPage === this.getTotalPages() - 1 && 0 !== this.currentPage ? this.getTotalPanels() - this.settings.visiblePanels : this.currentPage * this.settings.visiblePanels;
        },
        _getLastPanelFromPage: function () {
            return -1 === this.settings.visiblePanels ? this.getTotalPanels() - 1 : this.currentPage === this.getTotalPages() - 1 ? this.getTotalPanels() - 1 : (this.currentPage + 1) * this.settings.visiblePanels - 1;
        },
        _getPageOfPanel: function (x) {
            return this.currentPage === this.getTotalPages() - 1 && x >= this.getTotalPanels() - this.settings.visiblePanels ? this.getTotalPages() - 1 : Math.floor(x / this.settings.visiblePanels);
        },
        _updatePaginationButtons: function () {
            var x = this.$accordion.find(".as-pagination-buttons"),
                d = this,
                e = this.getTotalPages();
            if (1 >= e && 0 !== x.length) x.remove(), x.off("click." + z, ".as-pagination-button"), this.off("pageScroll." + z), this.$accordion.removeClass("as-has-buttons");
            else if (e > 1 && 0 === x.length) {
                x = y('<div class="as-pagination-buttons"></div>').appendTo(this.$accordion);
                for (var f = 0; f < this.getTotalPages(); f++) y('<div class="as-pagination-button"></div>').appendTo(x);
                x.on("click." + z, ".as-pagination-button", function () {
                    d.gotoPage(y(this).index());
                }),
                    x.find(".as-pagination-button").eq(this.currentPage).addClass("as-selected"),
                    this.on("pageScroll." + z, function (y) {
                        x.find(".as-selected").removeClass("as-selected"), x.find(".as-pagination-button").eq(y.index).addClass("as-selected");
                    }),
                    this.$accordion.addClass("as-has-buttons");
            } else if (e > 1 && 0 !== x.length) {
                x.empty();
                for (var g = 0; g < this.getTotalPages(); g++) y('<div class="as-pagination-button"></div>').appendTo(x);
                x.find(".as-selected").removeClass("as-selected"), x.find(".as-pagination-button").eq(this.currentPage).addClass("as-selected");
            }
        },
        defaults: {
            width: 800,
            height: 400,
            responsive: !0,
            responsiveMode: "auto",
            aspectRatio: -1,
            orientation: "horizontal",
            startPanel: -1,
            openedPanelSize: "max",
            maxOpenedPanelSize: "80%",
            openPanelOn: "hover",
            closePanelsOnMouseOut: !0,
            mouseDelay: 200,
            panelDistance: 0,
            openPanelDuration: 700,
            closePanelDuration: 700,
            pageScrollDuration: 500,
            pageScrollEasing: "swing",
            breakpoints: null,
            visiblePanels: -1,
            startPage: 0,
            shadow: !0,
            shuffle: !1,
            panelOverlap: !0,
            init: function () {},
            update: function () {},
            accordionMouseOver: function () {},
            accordionMouseOut: function () {},
            panelClick: function () {},
            panelMouseOver: function () {},
            panelMouseOut: function () {},
            panelOpen: function () {},
            panelsClose: function () {},
            pageScroll: function () {},
            panelOpenComplete: function () {},
            panelsCloseComplete: function () {},
            pageScrollComplete: function () {},
            breakpointReach: function () {},
        },
    };
    var e = function (x, b, d) {
        (this.$panel = x), (this.accordion = b), (this.settings = this.accordion.settings), (this.panelNS = "WPAccordionSliderPanel" + d + "." + z), (this.isLoading = !1), (this.isLoaded = !1), this.setIndex(d), this._init();
    };
    (e.prototype = {
        _init: function () {
            var x = this;
            this.$panel.attr("data-init", !0),
                this.on("mouseenter." + this.panelNS, function () {
                    x.trigger({ type: "panelMouseOver." + z, index: x.index });
                }),
                this.on("mouseleave." + this.panelNS, function () {
                    x.trigger({ type: "panelMouseOut." + z, index: x.index });
                }),
                this.on("click." + this.panelNS, function () {
                    x.trigger({ type: "panelClick." + z, index: x.index });
                }),
                this.on("mousedown." + this.panelNS, function () {
                    x.trigger({ type: "panelMouseDown." + z, index: x.index });
                }),
                this.update();
            var d = y.WPAccordionSlider.modules.panel;
            if ("undefined" != typeof d) for (var e = 0; e < d.length; e++) "undefined" != typeof this["init" + d[e]] && this["init" + d[e]]();
        },
        update: function () {
            (this.positionProperty = "horizontal" === this.settings.orientation ? "left" : "top"),
                (this.sizeProperty = "horizontal" === this.settings.orientation ? "width" : "height"),
                this.$panel.css({ top: "", left: "", width: "", height: "" });
        },
        destroy: function () {
            this.off("mouseenter." + this.panelNS),
                this.off("mouseleave." + this.panelNS),
                this.off("click." + this.panelNS),
                this.off("mousedown." + this.panelNS),
                this.$panel.attr("style", ""),
                this.$panel.removeAttr("data-init"),
                this.$panel.removeAttr("data-index");
            var x = y.WPAccordionSlider.modules.panel;
            if ("undefined" != typeof x) for (var z = 0; z < x.length; c++) "undefined" != typeof this["destroy" + x[z]] && this["destroy" + x[z]]();
        },
        getIndex: function () {
            return this.index;
        },
        setIndex: function (x) {
            (this.index = x), this.$panel.attr("data-index", this.index);
        },
        getPosition: function () {
            return parseInt(this.$panel.css(this.positionProperty), 10);
        },
        setPosition: function (x) {
            this.$panel.css(this.positionProperty, x);
        },
        getSize: function () {
            return parseInt(this.$panel.css(this.sizeProperty), 10);
        },
        setSize: function (x) {
            this.$panel.css(this.sizeProperty, x);
        },
        getContentSize: function () {
            if (this.isLoaded === !1 && "loading" === this.checkImagesComplete()) return "loading";
            this.$panel.find(".as-opened").css("display", "none");
            var x = "width" === this.sizeProperty ? this.$panel[0].scrollWidth : this.$panel[0].scrollHeight;
            return this.$panel.find(".as-opened").css("display", ""), x;
        },
        checkImagesComplete: function () {
            if (this.isLoading === !0) return "loading";
            var x = this,
                d = "complete";
            if (
                (this.$panel.find("img").each(function (x) {
                    var z = y(this)[0];
                    (z.complete === !1 || "undefined" != typeof y(this).attr("data-src")) && (d = "loading");
                }),
                "loading" === d)
            ) {
                this.isLoading = !0;
                var e = setInterval(function () {
                    var d = !0;
                    x.$panel.find("img").each(function (x) {
                        var z = y(this)[0];
                        (z.complete === !1 || "undefined" != typeof y(this).attr("data-src")) && (d = !1);
                    }),
                        d === !0 && ((x.isLoading = !1), (x.isLoaded = !0), clearInterval(e), x.trigger({ type: "imagesComplete." + z, index: x.index, contentSize: x.getContentSize() }));
                }, 100);
            } else this.isLoaded = !0;
            return d;
        },
        on: function (x, b) {
            return this.$panel.on(x, b);
        },
        off: function (x) {
            return this.$panel.off(x);
        },
        trigger: function (x) {
            return this.$panel.triggerHandler(x);
        },
    }),
        (x.WPAccordionSlider = d),
        (x.WPAccordionSliderPanel = e),
        (y.fn.WPaccordionSlider = function (x) {
            var z = Array.prototype.slice.call(arguments, 1);
            return this.each(function () {
                if ("undefined" == typeof y(this).data("WPaccordionSlider")) {
                    var e = new d(this, x);
                    y(this).data("WPaccordionSlider", e);
                } else if ("undefined" != typeof x) {
                    var f = y(this).data("WPaccordionSlider");
                    if ("function" == typeof f[x]) f[x].apply(f, z);
                    else if ("undefined" != typeof f.settings[x]) {
                        var g = {};
                        (g[x] = z[0]), f._setProperties(g);
                    } else "object" == typeof x ? f._setProperties(x) : y.error(x + " does not exist in Accordion Slider.");
                }
            });
        });
})(window, jQuery),

/*auto play*/
    (function (k, p) {
        "use strict";
        var m = p.WPAccordionSlider.namespace,
            n = {
                autoplayIndex: -1,
                autoplayTimer: null,
                isTimerRunning: !1,
                isTimerPaused: !1,
                initAutoplay: function () {
                    var k = this;
                    this.settings.autoplay === !0 && this.startAutoplay(),
                        this.on("panelOpen.Autoplay." + m, function (p) {
                            (k.autoplayIndex = p.index), k.settings.autoplay === !0 && (k.isTimerRunning === !0 && k.stopAutoplay(), k.isTimerPaused === !1 && k.startAutoplay());
                        }),
                        this.on("panelsClose.Autoplay." + m, function (p) {
                            -1 !== p.previousIndex && (k.autoplayIndex = p.previousIndex);
                        }),
                        this.on("pageScroll.Autoplay." + m, function (p) {
                            k.autoplayIndex = k._getFirstPanelFromPage() - 1;
                        }),
                        this.on("mouseenter.Autoplay." + m, function (p) {
                            k.settings.autoplay !== !0 || !k.isTimerRunning || ("pause" !== k.settings.autoplayOnHover && "stop" !== k.settings.autoplayOnHover) || (k.stopAutoplay(), (k.isTimerPaused = !0));
                        }),
                        this.on("mouseleave.Autoplay." + m, function (p) {
                            k.settings.autoplay === !0 && k.isTimerRunning === !1 && "stop" !== k.settings.autoplayOnHover && (k.startAutoplay(), (k.isTimerPaused = !1));
                        });
                },
                startAutoplay: function () {
                    var i = this;
                    (this.isTimerRunning = !0),
                        (this.autoplayTimer = setTimeout(function () {
                            -1 !== i.autoplayIndex && ((i.currentIndex = i.autoplayIndex), (i.autoplayIndex = -1)),
                                "normal" === i.settings.autoplayDirection ? i.nextPanel() : "backwards" === i.settings.autoplayDirection && i.previousPanel();
                        }, this.settings.autoplayDelay));
                },
                stopAutoplay: function () {
                    (this.isTimerRunning = !1), clearTimeout(this.autoplayTimer);
                },
                destroyAutoplay: function () {
                    clearTimeout(this.autoplayTimer), this.off("panelOpen.Autoplay." + m), this.off("pageScroll.Autoplay." + c), this.off("mouseenter.Autoplay." + c), this.off("mouseleave.Autoplay." + m);
                },
                autoplayDefaults: { autoplay: !0, autoplayDelay: 5e3, autoplayDirection: "normal", autoplayOnHover: "pause" },
            };
        p.WPAccordionSlider.addModule("Autoplay", n, "accordion");
    })(window, jQuery),

/*mouse wheel*/
    (function (k, p) {
        "use strict";
        var m = p.WPAccordionSlider.namespace,
            n = {
                mouseWheelEventType: "",
                allowMouseWheelScroll: !0,
                initMouseWheel: function () {
                    var k = this;
                    this.settings.mouseWheel !== !1 &&
                        ("onwheel" in document
                            ? (this.mouseWheelEventType = "wheel")
                            : "onmousewheel" in document
                            ? (this.mouseWheelEventType = "mousewheel")
                            : "onDomMouseScroll" in document
                            ? (this.mouseWheelEventType = "DomMouseScroll")
                            : "onMozMousePixelScroll" in document && (this.mouseWheelEventType = "MozMousePixelScroll"),
                        this.on(this.mouseWheelEventType + "." + m, function (p) {
                            p.preventDefault();
                            var m,
                                n = p.originalEvent;
                            "undefined" != typeof n.detail && (m = n.detail),
                                "undefined" != typeof n.wheelDelta && (m = n.wheelDelta),
                                "undefined" != typeof n.deltaY && (m = -1 * n.deltaY),
                                k.allowMouseWheelScroll === !0 &&
                                    Math.abs(m) >= k.settings.mouseWheelSensitivity &&
                                    ((k.allowMouseWheelScroll = !1),
                                    setTimeout(function () {
                                        k.allowMouseWheelScroll = !0;
                                    }, 500),
                                    m <= -k.settings.mouseWheelSensitivity
                                        ? "page" === k.settings.mouseWheelTarget
                                            ? k.nextPage()
                                            : k.nextPanel()
                                        : m >= k.settings.mouseWheelSensitivity && ("page" === k.settings.mouseWheelTarget ? k.previousPage() : k.previousPanel()));
                        }));
                },
                destroyMouseWheel: function () {
                    this.off(this.mouseWheelEventType + "." + m);
                },
                mouseWheelDefaults: { mouseWheel: !0, mouseWheelSensitivity: 10, mouseWheelTarget: "panel" },
            };
        p.WPAccordionSlider.addModule("MouseWheel", n, "accordion");
    })(window, jQuery),

/*mouse touch*/
    (function (k, p) {
        "use strict";
        var m = p.WPAccordionSlider.namespace,
            n = {
                touchStartPoint: { x: 0, y: 0 },
                touchEndPoint: { x: 0, y: 0 },
                touchDistance: { x: 0, y: 0 },
                touchStartPosition: 0,
                isTouchMoving: !1,
                touchSwipeEvents: { startEvent: "", moveEvent: "", endEvent: "" },
                previousStartEvent: "",
                initTouchSwipe: function () {
                    var k = this;
                    this.settings.touchSwipe !== !1 &&
                        ((this.touchSwipeEvents.startEvent = "touchstart." + m + " mousedown." + m),
                        (this.touchSwipeEvents.moveEvent = "touchmove." + m + " mousemove." + m),
                        (this.touchSwipeEvents.endEvent = "touchend." + this.uniqueId + "." + m + " mouseup." + this.uniqueId + "." + m),
                        this.$panelsContainer.on(this.touchSwipeEvents.startEvent, p.proxy(this._onTouchStart, this)),
                        this.$panelsContainer.on("dragstart." + m, function (k) {
                            k.preventDefault();
                        }),
                        this.$panelsContainer.find("a").on("click." + m, function (p) {
                            k.$accordion.hasClass("as-swiping") && p.preventDefault();
                        }),
                        this.$panelsContainer.on("touchstart." + m, function (k) {
                            p(this).find("[data-disabledlink]").css("pointer-events", "").removeAttr("data-disabledlink");
                        }),
                        this.$panelsContainer.find("a").on("touchend." + m, function (k) {
                            p(this).parents(".as-panel").hasClass("as-opened") === !1 && (p(this).css("pointer-events", "none"), p(this).attr("data-disabledlink", "true"));
                        }),
                        this.on("update.TouchSwipe." + m, function () {
                            k.getTotalPages() > 1 ? k.$panelsContainer.addClass("as-grab") : k.$panelsContainer.removeClass("as-grab");
                        }));
                },
                _onTouchStart: function (k) {
                    if ("mousedown" === k.type && "touchstart" === this.previousStartEvent) return void (this.previousStartEvent = k.type);
                    this.previousStartEvent = k.type;
                    var m = "undefined" != typeof k.originalEvent.touches ? k.originalEvent.touches[0] : k.originalEvent;
                    p(k.target).closest(".as-selectable").length >= 1 ||
                        ("undefined" == typeof k.originalEvent.touches && 1 === this.getTotalPages()) ||
                        ((this.touchStartPoint.x = m.pageX || m.clientX),
                        (this.touchStartPoint.y = m.pageY || m.clientY),
                        (this.touchStartPosition = parseInt(this.$panelsContainer.css(this.positionProperty), 10)),
                        (this.touchDistance.x = this.touchDistance.y = 0),
                        this.$panelsContainer.on(this.touchSwipeEvents.moveEvent, p.proxy(this._onTouchMove, this)),
                        p(document).on(this.touchSwipeEvents.endEvent, p.proxy(this._onTouchEnd, this)),
                        this.$panelsContainer.removeClass("as-grab").addClass("as-grabbing"));
                },
                _onTouchMove: function (k) {
                    var p = "undefined" != typeof k.originalEvent.touches ? k.originalEvent.touches[0] : k.originalEvent;
                    (this.isTouchMoving = !0),
                        this.$accordion.hasClass("as-swiping") === !1 && this.$accordion.addClass("as-swiping"),
                        (this.touchEndPoint.x = p.pageX || p.clientX),
                        (this.touchEndPoint.y = p.pageY || p.clientY),
                        (this.touchDistance.x = this.touchEndPoint.x - this.touchStartPoint.x),
                        (this.touchDistance.y = this.touchEndPoint.y - this.touchStartPoint.y);
                    var m = "horizontal" === this.settings.orientation ? this.touchDistance.x : this.touchDistance.y,
                        n = "horizontal" === this.settings.orientation ? this.touchDistance.y : this.touchDistance.x;
                    if (!(Math.abs(m) <= Math.abs(n) || 1 === this.getTotalPages() || (this.getTotalPages() > 1 && this.currentPage === this.getTotalPages() - 1))) {
                        k.preventDefault();
                        var e = parseInt(this.$panelsContainer.css(this.positionProperty), 10);
                        ((e >= 0 && 0 === this.currentPage) || (e <= -this.totalPanelsSize + this.totalSize && this.currentPage === this.getTotalPages() - 1)) && (m = 0.2 * m),
                            this.$panelsContainer.css(this.positionProperty, this.touchStartPosition + m);
                    }
                },
                _onTouchEnd: function (k) {
                    var m = this;
                    if (
                        (this.$panelsContainer.off(this.touchSwipeEvents.moveEvent),
                        p(document).off(this.touchSwipeEvents.endEvent),
                        this.$panelsContainer.removeClass("as-grabbing").addClass("as-grab"),
                        this.isTouchMoving === !1 || (this.isTouchMoving === !0 && Math.abs(this.touchDistance.x) < 10 && Math.abs(this.touchDistance.y) < 10))
                    ) {
                        var n = p(k.target).parents(".as-panel").index();
                        "undefined" != typeof k.originalEvent.touches && n !== this.currentIndex && -1 !== n && "never" !== this.openPanelOn && this.openPanel(n);
                    }
                    if (
                        (this.$accordion.hasClass("as-swiping") &&
                            setTimeout(function () {
                                m.$accordion.removeClass("as-swiping");
                            }, 100),
                        this.isTouchMoving !== !1)
                    ) {
                        this.isTouchMoving = !1;
                        var e = {};
                        (e[this.positionProperty] = this.touchStartPosition),
                            "horizontal" === this.settings.orientation
                                ? this.touchDistance.x > this.settings.touchSwipeThreshold
                                    ? this.currentPage > 0
                                        ? this.previousPage()
                                        : this.$panelsContainer.stop().animate(e, 300)
                                    : -this.touchDistance.x > this.settings.touchSwipeThreshold
                                    ? this.currentPage < this.getTotalPages() - 1
                                        ? this.nextPage()
                                        : this.gotoPage(this.currentPage)
                                    : Math.abs(this.touchDistance.x) < this.settings.touchSwipeThreshold && this.$panelsContainer.stop().animate(e, 300)
                                : "vertical" === this.settings.orientation &&
                                  (this.touchDistance.y > this.settings.touchSwipeThreshold
                                      ? this.currentPage > 0
                                          ? this.previousPage()
                                          : this.$panelsContainer.stop().animate(e, 300)
                                      : -this.touchDistance.y > this.settings.touchSwipeThreshold
                                      ? this.currentPage < this.getTotalPages() - 1
                                          ? this.nextPage()
                                          : this.$panelsContainer.animate(e, 300)
                                      : Math.abs(this.touchDistance.y) < this.settings.touchSwipeThreshold && this.$panelsContainer.stop().animate(e, 300));
                    }
                },
                destroyTouchSwipe: function () {
                    this.$panelsContainer.off("dragstart." + m),
                        this.$panelsContainer.find("a").off("click." + m),
                        this.$panelsContainer.find("a").off("touchstart." + m),
                        this.$panelsContainer.off(this.touchSwipeEvents.startEvent),
                        this.$panelsContainer.off(this.touchSwipeEvents.moveEvent),
                        p(document).off(this.touchSwipeEvents.endEvent),
                        this.off("update.TouchSwipe." + m),
                        this.$panelsContainer.removeClass("as-grab");
                },
                touchSwipeDefaults: { touchSwipe: !0, touchSwipeThreshold: 50 },
            };
        p.WPAccordionSlider.addModule("TouchSwipe", n, "accordion");
    })(window, jQuery),

    (function (k, p) {
        "use strict";
        var h = {
                XMLDataAttributesMap: {
                    width: "data-width",
                    height: "data-height",
                    depth: "data-depth",
                    position: "data-position",
                    horizontal: "data-horizontal",
                    vertical: "data-vertical",
                    showTransition: "data-show-transition",
                    showOffset: "data-show-offset",
                    showDelay: "data-show-delay",
                    showDuration: "data-show-duration",
                    showEasing: "data-show-easing",
                    hideTransition: "data-hide-transition",
                    hideOffset: "data-",
                    hideDelay: "data-hide-delay",
                    hideDuration: "data-hide-duration",
                    hideEasing: "data-hide-easing",
                },
                
            };
        
    })(window, jQuery);
