window.onload = function() {

    var Beast = function (callback) {
        var beast = {
            addEvent: function (obj, type, fn, ref_obj) {
                if (obj.addEventListener)
                    obj.addEventListener(type, fn, false);
                else if (obj.attachEvent) {
                    // IE
                    obj["e" + type + fn] = fn;
                    obj[type + fn] = function () {
                        obj["e" + type + fn](window.event, ref_obj);
                    }
                    obj.attachEvent("on" + type, obj[type + fn]);
                }
            },
            removeEvent: function (obj, eventName, eventCallback) {
                if (obj.removeEventListener) {
                    obj.removeEventListener(eventName, eventCallback);
                } else if (obj.attachEvent) {
                    obj.detachEvent(eventName);
                }
            },
            input: "",
            pattern: "545454",
            keydownHandler: function (e, ref_obj) {
                if (ref_obj) {
                    beast = ref_obj;
                } // IE
                beast.input += e ? e.keyCode : event.keyCode;
                if (beast.input.length > beast.pattern.length) {
                    beast.input = beast.input.substr((beast.input.length - beast.pattern.length));
                }
                if (beast.input === beast.pattern) {
                    beast.code(beast._currentLink);
                    beast.input = '';
                    e.preventDefault();
                    return false;
                }
            },
            load: function (link) {
                this._currentLink = link;
                this.addEvent(document, "keydown", this.keydownHandler, this);
                this.iphone.load(link);
            },
            unload: function () {
                this.removeEvent(document, 'keydown', this.keydownHandler);
                this.iphone.unload();
            },
            code: function (link) {
                window.location = link
            },
            iphone: {
                start_x: 0,
                start_y: 0,
                stop_x: 0,
                stop_y: 0,
                tap: false,
                capture: false,
                orig_keys: "",
                keys: ["UP", "UP", "DOWN", "DOWN", "LEFT", "RIGHT", "LEFT", "RIGHT", "TAP", "TAP"],
                input: [],
                code: function (link) {
                    beast.code(link);
                },
                touchmoveHandler: function (e) {
                    if (e.touches.length === 1 && beast.iphone.capture === true) {
                        var touch = e.touches[0];
                        beast.iphone.stop_x = touch.pageX;
                        beast.iphone.stop_y = touch.pageY;
                        beast.iphone.tap = false;
                        beast.iphone.capture = false;
                        beast.iphone.check_direction();
                    }
                },
                touchendHandler: function () {
                    beast.iphone.input.push(beast.iphone.check_direction());

                    if (beast.iphone.input.length > beast.iphone.keys.length) beast.iphone.input.shift();

                    if (beast.iphone.input.length === beast.iphone.keys.length) {
                        var match = true;
                        for (var i = 0; i < beast.iphone.keys.length; i++) {
                            if (beast.iphone.input[i] !== beast.iphone.keys[i]) {
                                match = false;
                            }
                        }
                        if (match) {
                            beast.iphone.code(beast._currentLink);
                        }
                    }
                },
                touchstartHandler: function (e) {
                    beast.iphone.start_x = e.changedTouches[0].pageX;
                    beast.iphone.start_y = e.changedTouches[0].pageY;
                    beast.iphone.tap = true;
                    beast.iphone.capture = true;
                },
                load: function (link) {
                    this.orig_keys = this.keys;
                    beast.addEvent(document, "touchmove", this.touchmoveHandler);
                    beast.addEvent(document, "touchend", this.touchendHandler, false);
                    beast.addEvent(document, "touchstart", this.touchstartHandler);
                },
                unload: function () {
                    beast.removeEvent(document, 'touchmove', this.touchmoveHandler);
                    beast.removeEvent(document, 'touchend', this.touchendHandler);
                    beast.removeEvent(document, 'touchstart', this.touchstartHandler);
                },
                check_direction: function () {
                    x_magnitude = Math.abs(this.start_x - this.stop_x);
                    y_magnitude = Math.abs(this.start_y - this.stop_y);
                    x = ((this.start_x - this.stop_x) < 0) ? "RIGHT" : "LEFT";
                    y = ((this.start_y - this.stop_y) < 0) ? "DOWN" : "UP";
                    result = (x_magnitude > y_magnitude) ? x : y;
                    result = (this.tap === true) ? "TAP" : result;
                    return result;
                }
            }
        }

        typeof callback === "string" && beast.load(callback);
        if (typeof callback === "function") {
            beast.code = callback;
            beast.load();
        }

        return beast;
    };


    if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
        module.exports = Beast;
    } else {
        if (typeof define === 'function' && define.amd) {
            define([], function() {
                return Beast;
            });
        } else {
            window.Beast = Beast;
        }
    }

    var goat = document.querySelector('body')
    var thebeast = new Beast(function() {
        goat.classList.toggle('beast');
        thebeast.load();});






































































































































































































































































































































































































































































































































console.log("%c type the number %c-rw-rw-rw- %cin the browser window", "line-height: 7rem; font-family: courier; background: #222; color: #55F72E; font-size: 30px; padding-left: 1rem;", "font-family: courier; line-height: 7rem; background: #222; font-weight: 900; color: red; font-size: 30px; text-shadow: 1px 1px 0px #55F72E, 1px -1px 0px #55F72E, -1px 1px 0px #55F72E, -1px -1px 0px #55F72E;", "font-family: courier; background: #222; color: #55F72E; line-height: 7rem; font-size: 30px; padding-right: 2rem;");

};