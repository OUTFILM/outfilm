/*!
 * v2.0.6 */
!function(factory) {
  if ("function" == typeof define && define.amd) {
    define(["jquery"], factory);
  } else {
    if ("object" == typeof module && module.exports) {
      /**
       * @param {?} PromiseArray
       * @param {number} $
       * @return {?}
       */
      module.exports = function(PromiseArray, $) {
        return void 0 === $ && ($ = "undefined" != typeof window ? require("jquery") : require("jquery")(PromiseArray)), factory($), $;
      };
    } else {
      factory(jQuery);
    }
  }
}(function($) {
  /**
   * @param {Node} element
   * @param {boolean} options
   * @return {undefined}
   */
  var start = function(element, options) {
    this.opts = $.extend(true, {}, $.extend({}, start.DEFAULTS, "object" == typeof options && options));
    this.$original_element = $(element);
    this.$original_element.data("froala.editor", this);
    /** @type {number} */
    this.id = ++$.FroalaEditor.ID;
    this.original_document = element.ownerDocument;
    this.original_window = "defaultView" in this.original_document ? this.original_document.defaultView : this.original_document.parentWindow;
    var oldScrollTop = $(this.original_window).scrollTop();
    this.$original_element.on("froala.doInit", $.proxy(function() {
      this.$original_element.off("froala.doInit");
      this.document = this.$el.get(0).ownerDocument;
      this.window = "defaultView" in this.document ? this.document.defaultView : this.document.parentWindow;
      this.$document = $(this.document);
      this.$window = $(this.window);
      if ("undefined" == typeof this.opts.pluginsEnabled) {
        /** @type {Array.<string>} */
        this.opts.pluginsEnabled = Object.keys($.FroalaEditor.PLUGINS);
      }
      if (this.opts.initOnClick) {
        this.load($.FroalaEditor.MODULES);
        this.$el.on("mousedown.init dragenter.init focus.init", $.proxy(function(e) {
          if (1 === e.which) {
            this.$el.off("mousedown.init dragenter.init focus.init");
            this.load($.FroalaEditor.MODULES);
            this.load($.FroalaEditor.PLUGINS);
            var el = e.originalEvent && e.originalEvent.originalTarget;
            if (el) {
              if ("IMG" == el.tagName) {
                $(el).trigger("mousedown");
              }
            }
            if ("undefined" == typeof this.ul) {
              this.destroy();
            }
            this.events.trigger("initialized");
          }
        }, this));
      } else {
        this.load($.FroalaEditor.MODULES);
        this.load($.FroalaEditor.PLUGINS);
        $(this.original_window).scrollTop(oldScrollTop);
        if ("undefined" == typeof this.ul) {
          this.destroy();
        }
        this.events.trigger("initialized");
      }
    }, this));
    this._init();
  };
  start.DEFAULTS = {
    initOnClick : false
  };
  start.MODULES = {};
  start.PLUGINS = {};
  /** @type {string} */
  start.VERSION = "2.0.6";
  /** @type {Array} */
  start.INSTANCES = [];
  /** @type {number} */
  start.ID = 0;
  /**
   * @return {undefined}
   */
  start.prototype._init = function() {
    var nodeName = this.$original_element.prop("tagName");
    var CLICK = $.proxy(function() {
      this._original_html = this._original_html || this.$original_element.html();
      this.$box = this.$box || this.$original_element;
      if (this.opts.fullPage) {
        /** @type {boolean} */
        this.opts.iframe = true;
      }
      if (this.opts.iframe) {
        this.$iframe = $('<iframe src="about:blank" frameBorder="0">');
        this.$wp = $("<div></div>");
        this.$box.html(this.$wp);
        this.$wp.append(this.$iframe);
        this.$iframe.get(0).contentWindow.document.open();
        this.$iframe.get(0).contentWindow.document.write("<!DOCTYPE html>");
        this.$iframe.get(0).contentWindow.document.write("<html><head></head><body></body></html>");
        this.$iframe.get(0).contentWindow.document.close();
        this.$el = this.$iframe.contents().find("body");
        this.$head = this.$iframe.contents().find("head");
        this.$html = this.$iframe.contents().find("html");
        this.iframe_document = this.$iframe.get(0).contentWindow.document;
        this.$original_element.trigger("froala.doInit");
      } else {
        this.$el = $("<div></div>");
        this.$wp = $("<div></div>").append(this.$el);
        this.$box.html(this.$wp);
        this.$original_element.trigger("froala.doInit");
      }
    }, this);
    var addAll = $.proxy(function() {
      this.$box = $("<div>");
      this.$original_element.before(this.$box).hide();
      this._original_html = this.$original_element.val();
      this.$original_element.parents("form").on("submit." + this.id, $.proxy(function() {
        this.events.trigger("form.submit");
      }, this));
      CLICK();
    }, this);
    var requestAnimationFrame = $.proxy(function() {
      this.$el = this.$original_element;
      this.$el.attr("contenteditable", true).css("outline", "none");
      /** @type {boolean} */
      this.opts.multiLine = false;
      /** @type {boolean} */
      this.opts.toolbarInline = false;
      this.$original_element.trigger("froala.doInit");
    }, this);
    var to_string = $.proxy(function() {
      this.$el = this.$original_element;
      /** @type {boolean} */
      this.opts.toolbarInline = false;
      this.$original_element.trigger("froala.doInit");
    }, this);
    var attach = $.proxy(function() {
      this.$el = this.$original_element;
      /** @type {boolean} */
      this.opts.toolbarInline = false;
      this.$original_element.on("click.popup", function(types) {
        types.preventDefault();
      });
      this.$original_element.trigger("froala.doInit");
    }, this);
    if (this.opts.editInPopup) {
      attach();
    } else {
      if ("TEXTAREA" == nodeName) {
        addAll();
      } else {
        if ("A" == nodeName) {
          requestAnimationFrame();
        } else {
          if ("IMG" == nodeName) {
            to_string();
          } else {
            if ("BUTTON" == nodeName || "INPUT" == nodeName) {
              /** @type {boolean} */
              this.opts.editInPopup = true;
              /** @type {boolean} */
              this.opts.toolbarInline = false;
              attach();
            } else {
              CLICK();
            }
          }
        }
      }
    }
  };
  /**
   * @param {?} map
   * @return {?}
   */
  start.prototype.load = function(map) {
    var letter;
    for (letter in map) {
      if (!this[letter] && (!($.FroalaEditor.PLUGINS[letter] && this.opts.pluginsEnabled.indexOf(letter) < 0) && (this[letter] = new map[letter](this), this[letter]._init && (this[letter]._init(), this.opts.initOnClick && "core" == letter)))) {
        return false;
      }
    }
  };
  /**
   * @return {undefined}
   */
  start.prototype.destroy = function() {
    this.events.trigger("destroy");
    this.$original_element.parents("form").off("submit." + this.id);
    this.$original_element.off("click.popup");
    this.$original_element.removeData("froala.editor");
  };
  /**
   * @param {string} opts
   * @return {?}
   */
  $.fn.froalaEditor = function(opts) {
    /** @type {Array} */
    var args = [];
    /** @type {number} */
    var i = 0;
    for (;i < arguments.length;i++) {
      args.push(arguments[i]);
    }
    if ("string" == typeof opts) {
      /** @type {Array} */
      var out = [];
      return this.each(function() {
        var $spy = $(this);
        var nodes = $spy.data("froala.editor");
        if (nodes) {
          var node;
          var functionName;
          if (opts.indexOf(".") > 0 && nodes[opts.split(".")[0]] ? (nodes[opts.split(".")[0]] && (node = nodes[opts.split(".")[0]]), functionName = opts.split(".")[1]) : (node = nodes, functionName = opts.split(".")[0]), !node[functionName]) {
            return $.error("Method " + opts + " does not exist in Froala Editor.");
          }
          var copies = node[functionName].apply(nodes, args.slice(1));
          if (void 0 === copies) {
            out.push(this);
          } else {
            if (0 === out.length) {
              out.push(copies);
            }
          }
        }
      }), 1 == out.length ? out[0] : out;
    }
    return "object" != typeof opts && opts ? void 0 : this.each(function() {
      var d = $(this).data("froala.editor");
      if (!d) {
        new start(this, opts);
      }
    });
  };
  /** @type {function (Node, boolean): undefined} */
  $.fn.froalaEditor.Constructor = start;
  /** @type {function (Node, boolean): undefined} */
  $.FroalaEditor = start;
  /**
   * @param {Window} item
   * @return {?}
   */
  $.FroalaEditor.MODULES.node = function(item) {
    /**
     * @param {Node} dataAndEvents
     * @return {?}
     */
    function clone(dataAndEvents) {
      return dataAndEvents && "IFRAME" != dataAndEvents.tagName ? $(dataAndEvents).contents() : [];
    }
    /**
     * @param {?} node
     * @return {?}
     */
    function fn(node) {
      return node ? node.nodeType != Node.ELEMENT_NODE ? false : $.FroalaEditor.BLOCK_TAGS.indexOf(node.tagName.toLowerCase()) >= 0 : false;
    }
    /**
     * @param {?} node
     * @param {boolean} dataAndEvents
     * @return {?}
     */
    function update(node, dataAndEvents) {
      if ($(node).find("table").length > 0) {
        return false;
      }
      var a = clone(node);
      if (1 == a.length) {
        if (fn(a[0])) {
          a = clone(a[0]);
        }
      }
      /** @type {boolean} */
      var g = false;
      /** @type {number} */
      var i = 0;
      for (;i < a.length;i++) {
        var li = a[i];
        if (!dataAndEvents || !$(li).hasClass("fr-marker")) {
          if (!("BR" == li.tagName || li.textContent && 0 == li.textContent.replace(/\u200B/gi, "").length) || 1 == g) {
            return false;
          }
          if ("BR" == li.tagName) {
            /** @type {boolean} */
            g = true;
          }
        }
      }
      return true;
    }
    /**
     * @param {string} node
     * @return {?}
     */
    function set(node) {
      for (;node && (node.parentNode !== item.$el.get(0) && (!node.parentNode || !$(node.parentNode).hasClass("fr-inner")));) {
        if (node = node.parentNode, fn(node)) {
          return node;
        }
      }
      return null;
    }
    /**
     * @param {Element} node
     * @param {Array} parents
     * @param {boolean} keepData
     * @return {?}
     */
    function remove(node, parents, keepData) {
      if ("undefined" == typeof parents && (parents = []), "undefined" == typeof keepData && (keepData = true), parents.push(item.$el.get(0)), parents.indexOf(node.parentNode) >= 0 || (node.parentNode && $(node.parentNode).hasClass("fr-inner") || node.parentNode && ($.FroalaEditor.SIMPLE_ENTER_TAGS.indexOf(node.parentNode.tagName) >= 0 && keepData))) {
        return null;
      }
      for (;parents.indexOf(node.parentNode) < 0 && (node.parentNode && (!$(node.parentNode).hasClass("fr-inner") && (($.FroalaEditor.SIMPLE_ENTER_TAGS.indexOf(node.parentNode.tagName) < 0 || !keepData) && (!fn(node) || (!fn(node.parentNode) || !keepData)))));) {
        node = node.parentNode;
      }
      return node;
    }
    /**
     * @param {Object} model
     * @return {?}
     */
    function each(model) {
      var obj = {};
      var codeSegments = model.attributes;
      if (codeSegments) {
        /** @type {number} */
        var i = 0;
        for (;i < codeSegments.length;i++) {
          var attribute = codeSegments[i];
          obj[attribute.nodeName] = attribute.value;
        }
      }
      return obj;
    }
    /**
     * @param {boolean} other
     * @return {?}
     */
    function compare(other) {
      /** @type {string} */
      var optsData = "";
      var scrubbed = each(other);
      var codeSegments = Object.keys(scrubbed).sort();
      /** @type {number} */
      var i = 0;
      for (;i < codeSegments.length;i++) {
        var name = codeSegments[i];
        var set = scrubbed[name];
        optsData += set.indexOf('"') < 0 ? " " + name + '="' + set + '"' : " " + name + "='" + set + "'";
      }
      return optsData;
    }
    /**
     * @param {Element} child
     * @return {undefined}
     */
    function setProperty(child) {
      var attributes = child.attributes;
      /** @type {number} */
      var i = 0;
      for (;i < attributes.length;i++) {
        var attribute = attributes[i];
        child.removeAttribute(attribute.nodeName);
      }
    }
    /**
     * @param {Element} node
     * @return {?}
     */
    function func(node) {
      return "<" + node.tagName.toLowerCase() + compare(node) + ">";
    }
    /**
     * @param {?} node
     * @return {?}
     */
    function append(node) {
      return "</" + node.tagName.toLowerCase() + ">";
    }
    /**
     * @param {Element} s
     * @param {boolean} execResult
     * @return {?}
     */
    function parse(s, execResult) {
      if ("undefined" == typeof execResult) {
        /** @type {boolean} */
        execResult = true;
      }
      var node = s.previousSibling;
      for (;node && (execResult && $(node).hasClass("fr-marker"));) {
        node = node.previousSibling;
      }
      return node ? node.nodeType == Node.TEXT_NODE && "" === node.textContent ? parse(node) : false : true;
    }
    /**
     * @param {Function} node
     * @return {?}
     */
    function is(node) {
      return node && $.FroalaEditor.VOID_ELEMENTS.indexOf((node.tagName || "").toLowerCase()) >= 0;
    }
    /**
     * @param {?} context
     * @return {?}
     */
    function init(context) {
      return context ? ["UL", "OL"].indexOf(context.tagName) >= 0 : false;
    }
    /**
     * @param {Element} arr
     * @return {?}
     */
    function done(arr) {
      return arr === item.$el.get(0);
    }
    /**
     * @param {Element} element
     * @return {?}
     */
    function setup(element) {
      return element === item.document.activeElement && ((!item.document.hasFocus || item.document.hasFocus()) && !!(done(element) || (element.type || (element.href || ~element.tabIndex))));
    }
    /**
     * @param {?} node
     * @return {?}
     */
    function isEditable(node) {
      return!node.getAttribute || "false" != node.getAttribute("contenteditable");
    }
    return{
      /** @type {function (?): ?} */
      isBlock : fn,
      /** @type {function (?, boolean): ?} */
      isEmpty : update,
      /** @type {function (string): ?} */
      blockParent : set,
      /** @type {function (Element, Array, boolean): ?} */
      deepestParent : remove,
      /** @type {function (Object): ?} */
      rawAttributes : each,
      /** @type {function (boolean): ?} */
      attributes : compare,
      /** @type {function (Element): undefined} */
      clearAttributes : setProperty,
      /** @type {function (Element): ?} */
      openTagString : func,
      /** @type {function (?): ?} */
      closeTagString : append,
      /** @type {function (Element, boolean): ?} */
      isFirstSibling : parse,
      /** @type {function (?): ?} */
      isList : init,
      /** @type {function (Element): ?} */
      isElement : done,
      /** @type {function (Node): ?} */
      contents : clone,
      /** @type {function (Function): ?} */
      isVoid : is,
      /** @type {function (Element): ?} */
      hasFocus : setup,
      /** @type {function (?): ?} */
      isEditable : isEditable
    };
  };
  $.extend($.FroalaEditor.DEFAULTS, {
    htmlAllowedTags : ["a", "abbr", "address", "area", "article", "aside", "audio", "b", "base", "bdi", "bdo", "blockquote", "br", "button", "canvas", "caption", "cite", "code", "col", "colgroup", "datalist", "dd", "del", "details", "dfn", "dialog", "div", "dl", "dt", "em", "embed", "fieldset", "figcaption", "figure", "footer", "form", "h1", "h2", "h3", "h4", "h5", "h6", "header", "hgroup", "hr", "i", "iframe", "img", "input", "ins", "kbd", "keygen", "label", "legend", "li", "link", "main", "map", 
    "mark", "menu", "menuitem", "meter", "nav", "noscript", "object", "ol", "optgroup", "option", "output", "p", "param", "pre", "progress", "queue", "rp", "rt", "ruby", "s", "samp", "script", "style", "section", "select", "small", "source", "span", "strike", "strong", "sub", "summary", "sup", "table", "tbody", "td", "textarea", "tfoot", "th", "thead", "time", "tr", "track", "u", "ul", "var", "video", "wbr"],
    htmlRemoveTags : ["script", "style"],
    htmlAllowedAttrs : ["accept", "accept-charset", "accesskey", "action", "align", "allowfullscreen", "allowtransparency", "alt", "async", "autocomplete", "autofocus", "autoplay", "autosave", "background", "bgcolor", "border", "charset", "cellpadding", "cellspacing", "checked", "cite", "class", "color", "cols", "colspan", "content", "contenteditable", "contextmenu", "controls", "coords", "data", "data-.*", "datetime", "default", "defer", "dir", "dirname", "disabled", "download", "draggable", "dropzone", 
    "enctype", "for", "form", "formaction", "fr-.*", "frameborder", "headers", "height", "hidden", "high", "href", "hreflang", "http-equiv", "icon", "id", "ismap", "itemprop", "keytype", "kind", "label", "lang", "language", "list", "loop", "low", "max", "maxlength", "media", "method", "min", "mozallowfullscreen", "multiple", "name", "novalidate", "open", "optimum", "pattern", "ping", "placeholder", "poster", "preload", "pubdate", "radiogroup", "readonly", "rel", "required", "reversed", "rows", "rowspan", 
    "sandbox", "scope", "scoped", "scrolling", "seamless", "selected", "shape", "size", "sizes", "span", "src", "srcdoc", "srclang", "srcset", "start", "step", "summary", "spellcheck", "style", "tabindex", "target", "title", "type", "translate", "usemap", "value", "valign", "webkitallowfullscreen", "width", "wrap"],
    htmlAllowComments : true,
    fullPage : false
  });
  $.FroalaEditor.HTML5Map = {
    B : "STRONG",
    I : "EM",
    STRIKE : "S"
  };
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.clean = function(self) {
    /**
     * @param {Element} node
     * @return {?}
     */
    function process(node) {
      if (node.className && node.className.indexOf("fr-marker") >= 0) {
        return false;
      }
      var i;
      var a = self.node.contents(node);
      /** @type {Array} */
      var b = [];
      /** @type {number} */
      i = 0;
      for (;i < a.length;i++) {
        if (a[i].className) {
          if (a[i].className.indexOf("fr-marker") >= 0) {
            b.push(a[i]);
          }
        }
      }
      if (a.length - b.length == 1 && 0 === node.textContent.replace(/\u200b/g, "").length) {
        /** @type {number} */
        i = 0;
        for (;i < b.length;i++) {
          node.parentNode.insertBefore(b[i].cloneNode(true), node);
        }
        return node.parentNode.removeChild(node), false;
      }
      /** @type {number} */
      i = 0;
      for (;i < a.length;i++) {
        if (a[i].nodeType == Node.ELEMENT_NODE) {
          if (a[i].textContent.replace(/\u200b/g, "").length != a[i].textContent.length) {
            process(a[i]);
          }
        } else {
          if (a[i].nodeType == Node.TEXT_NODE) {
            a[i].textContent = a[i].textContent.replace(/\u200b/g, "");
          }
        }
      }
    }
    /**
     * @param {Node} node
     * @return {?}
     */
    function walk(node) {
      if (node.nodeType == Node.COMMENT_NODE) {
        return "\x3c!--" + node.nodeValue + "--\x3e";
      }
      if (node.nodeType == Node.TEXT_NODE) {
        return node.textContent.replace(/\</g, "&lt;").replace(/\>/g, "&gt;").replace(/\u00A0/g, "&nbsp;");
      }
      if (node.nodeType != Node.ELEMENT_NODE) {
        return node.outerHTML;
      }
      if (node.nodeType == Node.ELEMENT_NODE && ["STYLE", "SCRIPT"].indexOf(node.tagName) >= 0) {
        return node.outerHTML;
      }
      if ("IFRAME" == node.tagName) {
        return node.outerHTML;
      }
      var children = node.childNodes;
      if (0 === children.length) {
        return node.outerHTML;
      }
      /** @type {string} */
      var space = "";
      /** @type {number} */
      var i = 0;
      for (;i < children.length;i++) {
        space += walk(children[i]);
      }
      return self.node.openTagString(node) + space + self.node.closeTagString(node);
    }
    /**
     * @param {string} data
     * @return {?}
     */
    function done(data) {
      return arr = [], data = data.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, function(chunk) {
        return arr.push(chunk), "\x3c!--[FROALA.EDITOR.SCRIPT " + (arr.length - 1) + "]--\x3e";
      }), data = data.replace(/<img((?:[\w\W]*?)) src="/g, '<img$1 data-fr-src="');
    }
    /**
     * @param {string} data
     * @return {?}
     */
    function build(data) {
      return data = data.replace(/\x3c!--\[FROALA\.EDITOR\.SCRIPT ([\d]*)]--\x3e/gi, function(dataAndEvents, m1) {
        return arr[parseInt(m1, 10)];
      }), self.opts.htmlRemoveTags.indexOf("script") >= 0 && (data = data.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, "")), data = data.replace(/<img((?:[\w\W]*?)) data-fr-src="/g, '<img$1 src="');
    }
    /**
     * @param {Object} values
     * @return {?}
     */
    function next(values) {
      var p;
      for (p in values) {
        if (!p.match(reg)) {
          delete values[p];
        }
      }
      /** @type {string} */
      var rv = "";
      var codeSegments = Object.keys(values).sort();
      /** @type {number} */
      var i = 0;
      for (;i < codeSegments.length;i++) {
        p = codeSegments[i];
        rv += values[p].indexOf('"') < 0 ? " " + p + '="' + values[p] + '"' : " " + p + "='" + values[p] + "'";
      }
      return rv;
    }
    /**
     * @param {string} result
     * @param {string} k
     * @param {string} data
     * @return {?}
     */
    function callback(result, k, data) {
      if (self.opts.fullPage) {
        var newState = self.html.extractDoctype(data);
        var ch = next(self.html.extractNodeAttrs(data, "html"));
        k = null == k ? self.html.extractNode(data, "head") || "<title></title>" : k;
        var nextStream = next(self.html.extractNodeAttrs(data, "head"));
        var $next = next(self.html.extractNodeAttrs(data, "body"));
        return newState + "<html" + ch + "><head" + nextStream + ">" + k + "</head><body" + $next + ">" + result + "</body></html>";
      }
      return result;
    }
    /**
     * @param {string} target
     * @param {Function} callback
     * @return {?}
     */
    function expand(target, callback) {
      var cl = $("<div>" + target + "</div>");
      /** @type {string} */
      var ret = "";
      if (cl) {
        var codeSegments = self.node.contents(cl.get(0));
        /** @type {number} */
        var i = 0;
        for (;i < codeSegments.length;i++) {
          callback(codeSegments[i]);
        }
        codeSegments = self.node.contents(cl.get(0));
        /** @type {number} */
        i = 0;
        for (;i < codeSegments.length;i++) {
          ret += walk(codeSegments[i]);
        }
      }
      return ret;
    }
    /**
     * @param {string} a
     * @param {Function} type
     * @param {boolean} dataAndEvents
     * @return {?}
     */
    function require(a, type, dataAndEvents) {
      a = done(a);
      /** @type {string} */
      var arg = a;
      /** @type {null} */
      var value = null;
      if (self.opts.fullPage) {
        arg = (self.html.extractNode(a, "body") || a).replace(/\r|\n/g, "");
        if (dataAndEvents) {
          value = (self.html.extractNode(a, "head") || "").replace(/\r|\n/g, "");
        }
      }
      arg = expand(arg, type);
      if (value) {
        value = expand(value, type);
      }
      var pdataCur = callback(arg, value, a).replace(/\r|\n/g, "");
      return build(pdataCur);
    }
    /**
     * @param {string} b
     * @return {?}
     */
    function normalize(b) {
      return b.replace(/\u200b/g, "").length == b.length ? b : self.clean.exec(b, process);
    }
    /**
     * @return {undefined}
     */
    function update() {
      var others = self.$el.find(Object.keys($.FroalaEditor.HTML5Map).join(",")).filter(function() {
        return "" === self.node.attributes(this);
      });
      if (others.length) {
        self.selection.save();
        others.each(function() {
          $(this).replaceWith("<" + $.FroalaEditor.HTML5Map[this.tagName] + ">" + $(this).html() + "</" + $.FroalaEditor.HTML5Map[this.tagName] + ">");
        });
        self.selection.restore();
      }
    }
    /**
     * @param {boolean} el
     * @return {?}
     */
    function init(el) {
      if ("PRE" == el.tagName && hasClass(el), el.nodeType == Node.ELEMENT_NODE && (el.getAttribute("data-fr-src") && el.setAttribute("data-fr-src", self.helpers.sanitizeURL(el.getAttribute("data-fr-src"))), el.getAttribute("href") && el.setAttribute("href", self.helpers.sanitizeURL(el.getAttribute("href"))), ["TABLE", "TBODY", "TFOOT", "TR"].indexOf(el.tagName) >= 0 && (el.innerHTML = el.innerHTML.trim())), !self.opts.pasteAllowLocalImages && (el.nodeType == Node.ELEMENT_NODE && ("IMG" == el.tagName && 
      (el.getAttribute("data-fr-src") && 0 == el.getAttribute("data-fr-src").indexOf("file://"))))) {
        return el.parentNode.removeChild(el), false;
      }
      if (el.nodeType == Node.ELEMENT_NODE && ($.FroalaEditor.HTML5Map[el.tagName] && "" === self.node.attributes(el))) {
        var d = $.FroalaEditor.HTML5Map[el.tagName];
        /** @type {string} */
        var html = "<" + d + ">" + el.innerHTML + "</" + d + ">";
        el.insertAdjacentHTML("beforebegin", html);
        el = el.previousSibling;
        el.parentNode.removeChild(el.nextSibling);
      }
      if (self.opts.htmlAllowComments || el.nodeType != Node.COMMENT_NODE) {
        if (el.tagName && el.tagName.match(rxNotLatin)) {
          el.parentNode.removeChild(el);
        } else {
          if (el.tagName && !el.tagName.match(_regex)) {
            el.outerHTML = el.innerHTML;
          } else {
            var attrs = el.attributes;
            if (attrs) {
              /** @type {number} */
              var i = attrs.length - 1;
              for (;i >= 0;i--) {
                var attr = attrs[i];
                if (!attr.nodeName.match(reg)) {
                  el.removeAttribute(attr.nodeName);
                }
              }
            }
          }
        }
      } else {
        if (0 !== el.data.indexOf("[FROALA.EDITOR")) {
          el.parentNode.removeChild(el);
        }
      }
    }
    /**
     * @param {Object} node
     * @return {undefined}
     */
    function resolve(node) {
      var codeSegments = self.node.contents(node);
      /** @type {number} */
      var i = 0;
      for (;i < codeSegments.length;i++) {
        if (codeSegments[i].nodeType != Node.TEXT_NODE) {
          resolve(codeSegments[i]);
        }
      }
      init(node);
    }
    /**
     * @param {Object} o
     * @return {undefined}
     */
    function hasClass(o) {
      var txt = o.innerHTML;
      if (txt.indexOf("\n") >= 0) {
        o.innerHTML = txt.replace(/\n/g, "<br>");
      }
    }
    /**
     * @param {string} value
     * @param {Array} args
     * @param {Array} tag
     * @param {boolean} execResult
     * @return {?}
     */
    function parse(value, args, tag, execResult) {
      if ("undefined" == typeof args) {
        /** @type {Array} */
        args = [];
      }
      if ("undefined" == typeof tag) {
        /** @type {Array} */
        tag = [];
      }
      if ("undefined" == typeof execResult) {
        /** @type {boolean} */
        execResult = false;
      }
      value = value.replace(/\u0009/g, "");
      var i;
      var paths = $.merge([], self.opts.htmlAllowedTags);
      /** @type {number} */
      i = 0;
      for (;i < args.length;i++) {
        if (paths.indexOf(args[i]) >= 0) {
          paths.splice(paths.indexOf(args[i]), 1);
        }
      }
      var tags = $.merge([], self.opts.htmlAllowedAttrs);
      /** @type {number} */
      i = 0;
      for (;i < tag.length;i++) {
        if (tags.indexOf(tag[i]) >= 0) {
          tags.splice(tags.indexOf(tag[i]), 1);
        }
      }
      return _regex = new RegExp("^" + paths.join("$|^") + "$", "gi"), reg = new RegExp("^" + tags.join("$|^") + "$", "gi"), rxNotLatin = new RegExp("^" + self.opts.htmlRemoveTags.join("$|^") + "$", "gi"), value = require(value, resolve, true);
    }
    /**
     * @return {undefined}
     */
    function select() {
      var codeSegments = self.$el.find("blockquote + blockquote");
      /** @type {number} */
      var i = 0;
      for (;i < codeSegments.length;i++) {
        var selected = $(codeSegments[i]);
        if (self.node.attributes(codeSegments[i]) == self.node.attributes(selected.prev().get(0))) {
          selected.prev().append(selected.html());
          selected.remove();
        }
      }
    }
    /**
     * @return {undefined}
     */
    function load() {
      var arr = self.$el.find("tr").filter(function() {
        return $(this).find("th").length > 0;
      });
      /** @type {number} */
      var i = 0;
      for (;i < arr.length;i++) {
        var value = $(arr[i]).parents("table:first").find("thead");
        if (0 === value.length) {
          value = $("<thead>");
          $(arr[i]).parents("table:first").prepend(value);
          value.append(arr[i]);
        }
      }
      self.$el.find("table").filter(function() {
        var node = this.previousSibling;
        for (;node && (node.nodeType == Node.TEXT_NODE && 0 == node.textContent.length);) {
          node = node.previousSibling;
        }
        return node && (!self.node.isBlock(node) && "BR" != node.tagName) ? true : false;
      }).before("<br>");
      var index = self.html.defaultTag();
      if (index) {
        self.$el.find("td > " + index + ", th > " + index).each(function() {
          if ("" === self.node.attributes(this)) {
            $(this).replaceWith(this.innerHTML + "<br>");
          }
        });
      }
    }
    /**
     * @return {undefined}
     */
    function create() {
      var b = self.$el.find("ol + ol, ul + ul");
      /** @type {number} */
      var j = 0;
      for (;j < b.length;j++) {
        var selected = $(b[j]);
        if (self.node.attributes(b[j]) == self.node.attributes(selected.prev().get(0))) {
          selected.prev().append(selected.html());
          selected.remove();
        }
      }
      /** @type {Array} */
      var popup = [];
      /**
       * @return {?}
       */
      var create = function() {
        return!self.node.isList(this.parentNode);
      };
      do {
        if (popup.length) {
          var el = popup.get(0);
          var list = $("<ul></ul>").insertBefore($(el));
          do {
            var d = el;
            el = el.nextSibling;
            list.append($(d));
          } while (el && "LI" == el.tagName);
        }
        popup = self.$el.find("li").filter(create);
      } while (popup.length > 0);
      var k;
      /**
       * @param {?} opt_attributes
       * @param {?} selector
       * @return {undefined}
       */
      var setup = function(opt_attributes, selector) {
        var element = $(selector);
        if (0 === element.find("LI").length) {
          /** @type {boolean} */
          k = true;
          element.remove();
        }
      };
      do {
        /** @type {boolean} */
        k = false;
        self.$el.find("li:empty").remove();
        self.$el.find("ul, ol").each(setup);
      } while (k === true);
      var codeSegments = self.$el.find("ol, ul").find("> ul, > ol");
      /** @type {number} */
      var i = 0;
      for (;i < codeSegments.length;i++) {
        var node = codeSegments[i];
        var current = node.previousSibling;
        if (current) {
          if ("LI" == current.tagName) {
            $(current).append(node);
          } else {
            $(node).wrap("<li></li>");
          }
        }
      }
      self.$el.find("li > ul, li > ol").each(function(dataAndEvents, elem) {
        if (elem.nextSibling) {
          var cursor = elem.nextSibling;
          var warningLi = $("<li>");
          $(elem.parentNode).after(warningLi);
          do {
            var lineSeparator = cursor;
            cursor = cursor.nextSibling;
            warningLi.append(lineSeparator);
          } while (cursor);
        }
      });
      self.$el.find("li > ul, li > ol").each(function(dataAndEvents, node) {
        if (self.node.isFirstSibling(node)) {
          $(node).before("<br/>");
        } else {
          if (node.previousSibling && "BR" == node.previousSibling.tagName) {
            var link = node.previousSibling.previousSibling;
            for (;link && $(link).hasClass("fr-marker");) {
              link = link.previousSibling;
            }
            if (link) {
              if ("BR" != link.tagName) {
                $(node.previousSibling).remove();
              }
            }
          }
        }
      });
      self.$el.find("li:empty").remove();
    }
    /**
     * @return {undefined}
     */
    function dataToHtml() {
      if (self.opts.fullPage) {
        $.merge(self.opts.htmlAllowedTags, ["head", "title", "style", "link", "base", "body", "html"]);
      }
    }
    var _regex;
    var rxNotLatin;
    var reg;
    /** @type {Array} */
    var arr = [];
    /** @type {Array} */
    arr = [];
    return{
      /** @type {function (): undefined} */
      _init : dataToHtml,
      /** @type {function (string, Array, Array, boolean): ?} */
      html : parse,
      /** @type {function (): undefined} */
      toHTML5 : update,
      /** @type {function (): undefined} */
      tables : load,
      /** @type {function (): undefined} */
      lists : create,
      /** @type {function (): undefined} */
      quotes : select,
      /** @type {function (string): ?} */
      invisibleSpaces : normalize,
      /** @type {function (string, Function, boolean): ?} */
      exec : require
    };
  };
  /** @type {number} */
  $.FroalaEditor.XS = 0;
  /** @type {number} */
  $.FroalaEditor.SM = 1;
  /** @type {number} */
  $.FroalaEditor.MD = 2;
  /** @type {number} */
  $.FroalaEditor.LG = 3;
  /**
   * @param {Object} obj
   * @return {?}
   */
  $.FroalaEditor.MODULES.helpers = function(obj) {
    /**
     * @return {?}
     */
    function getIE() {
      var val;
      var re2;
      /** @type {number} */
      var q = -1;
      return "Microsoft Internet Explorer" == navigator.appName ? (val = navigator.userAgent, re2 = new RegExp("MSIE ([0-9]{1,}[\\.0-9]{0,})"), null !== re2.exec(val) && (q = parseFloat(RegExp.$1))) : "Netscape" == navigator.appName && (val = navigator.userAgent, re2 = new RegExp("Trident/.*rv:([0-9]{1,}[\\.0-9]{0,})"), null !== re2.exec(val) && (q = parseFloat(RegExp.$1))), q;
    }
    /**
     * @return {?}
     */
    function handler() {
      var browser = {};
      if (getIE() > 0) {
        /** @type {boolean} */
        browser.msie = true;
      } else {
        /** @type {string} */
        var ok = navigator.userAgent.toLowerCase();
        /** @type {Array.<string>} */
        var segmentMatch = /(edge)[ \/]([\w.]+)/.exec(ok) || (/(chrome)[ \/]([\w.]+)/.exec(ok) || (/(webkit)[ \/]([\w.]+)/.exec(ok) || (/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ok) || (/(msie) ([\w.]+)/.exec(ok) || (ok.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ok) || [])))));
        var result = {
          browser : segmentMatch[1] || "",
          version : segmentMatch[2] || "0"
        };
        if (segmentMatch[1]) {
          /** @type {boolean} */
          browser[result.browser] = true;
        }
        if (parseInt(result.version, 10) < 9) {
          if (browser.msie) {
            /** @type {boolean} */
            browser.oldMsie = true;
          }
        }
        if (browser.chrome) {
          /** @type {boolean} */
          browser.webkit = true;
        } else {
          if (browser.webkit) {
            /** @type {boolean} */
            browser.safari = true;
          }
        }
      }
      return browser;
    }
    /**
     * @return {?}
     */
    function next() {
      return/(iPad|iPhone|iPod)/g.test(navigator.userAgent) && !done();
    }
    /**
     * @return {?}
     */
    function inspect() {
      return/(Android)/g.test(navigator.userAgent) && !done();
    }
    /**
     * @return {?}
     */
    function check() {
      return/(Blackberry)/g.test(navigator.userAgent);
    }
    /**
     * @return {?}
     */
    function done() {
      return/(Windows Phone)/gi.test(navigator.userAgent);
    }
    /**
     * @return {?}
     */
    function exports() {
      return inspect() || (next() || check());
    }
    /**
     * @return {?}
     */
    function requestAnimationFrame() {
      return window.requestAnimationFrame || (window.webkitRequestAnimationFrame || (window.mozRequestAnimationFrame || function(after) {
        window.setTimeout(after, 1E3 / 60);
      }));
    }
    /**
     * @param {?} index
     * @return {?}
     */
    function cont(index) {
      return parseInt(index, 10) || 0;
    }
    /**
     * @return {?}
     */
    function get() {
      var $div = $('<div class="fr-visibility-helper"></div>').appendTo("body");
      var ret = cont($div.css("margin-left"));
      return $div.remove(), ret;
    }
    /**
     * @return {?}
     */
    function isTouch() {
      return "ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch;
    }
    /**
     * @param {string} str
     * @return {?}
     */
    function compile(str) {
      if (!/^(https?:|ftps?:|)\/\//.test(str)) {
        return false;
      }
      /** @type {string} */
      str = String(str).replace(/</g, "%3C").replace(/>/g, "%3E").replace(/"/g, "%22").replace(/ /g, "%20");
      /** @type {RegExp} */
      var hChars = /\(?(?:(https?:|ftps?:|)\/\/)?(?:((?:[^\W\s]|\.|-|[:]{1})+)@{1})?((?:www.)?(?:[^\W\s]|\.|-)+[\.][^\W\s]{2,4}|(?:www.)?(?:[^\W\s]|\.|-)|localhost|\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(?::(\d*))?([\/]?[^\s\?]*[\/]{1})*(?:\/?([^\s\n\?\[\]\{\}\#]*(?:(?=\.)){1}|[^\s\n\?\[\]\{\}\.\#]*)?([\.]{1}[^\s\?\#]*)?)?(?:\?{1}([^\s\n\#\[\]]*))?([\#][^\s\n]*)?\)?/gi;
      return hChars.test(str);
    }
    /**
     * @param {Text} str
     * @return {?}
     */
    function trim(str) {
      if (/^(https?:|ftps?:|)\/\//.test(str)) {
        if (!compile(str)) {
          return "";
        }
      } else {
        /** @type {string} */
        str = encodeURIComponent(str).replace(/%23/g, "#").replace(/%2F/g, "/").replace(/%25/g, "%").replace(/mailto%3A/g, "mailto:").replace(/file%3A/g, "file:").replace(/sms%3A/g, "sms:").replace(/tel%3A/g, "tel:").replace(/notes%3A/g, "notes:").replace(/data%3Aimage/g, "data:image").replace(/webkit-fake-url%3A/g, "webkit-fake-url:").replace(/%3F/g, "?").replace(/%3D/g, "=").replace(/%26/g, "&").replace(/&amp;/g, "&").replace(/%2C/g, ",").replace(/%3B/g, ";").replace(/%2B/g, "+").replace(/%40/g, 
        "@");
      }
      return str;
    }
    /**
     * @param {boolean} obj
     * @return {?}
     */
    function _isArray(obj) {
      return obj && (!obj.propertyIsEnumerable("length") && ("object" == typeof obj && "number" == typeof obj.length));
    }
    /**
     * @param {string} selector
     * @return {?}
     */
    function init(selector) {
      /**
       * @param {?} s
       * @return {?}
       */
      function hex(s) {
        return("0" + parseInt(s, 10).toString(16)).slice(-2);
      }
      try {
        return selector && "transparent" !== selector ? /^#[0-9A-F]{6}$/i.test(selector) ? selector : (selector = selector.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/), ("#" + hex(selector[1]) + hex(selector[2]) + hex(selector[3])).toUpperCase()) : "";
      } catch (c) {
        return null;
      }
    }
    /**
     * @param {string} value
     * @return {?}
     */
    function set(value) {
      /** @type {RegExp} */
      var rxhtmlTag = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
      value = value.replace(rxhtmlTag, function(dataAndEvents, $1, $2, a_text) {
        return $1 + $1 + $2 + $2 + a_text + a_text;
      });
      /** @type {(Array.<string>|null)} */
      var num = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(value);
      return num ? "rgb(" + parseInt(num[1], 16) + ", " + parseInt(num[2], 16) + ", " + parseInt(num[3], 16) + ")" : "";
    }
    /**
     * @param {Object} context
     * @return {?}
     */
    function render(context) {
      var ee = (context.css("text-align") || "").replace(/-(.*)-/g, "");
      if (["left", "right", "justify", "center"].indexOf(ee) < 0) {
        if (!location) {
          var head = $('<div dir="auto" style="text-align: initial; position: fixed; left: -3000px;"><span id="s1">.</span><span id="s2">.</span></div>');
          $("body").append(head);
          var k = head.find("#s1").get(0).getBoundingClientRect().left;
          var xdiff = head.find("#s2").get(0).getBoundingClientRect().left;
          head.remove();
          /** @type {string} */
          location = xdiff > k ? "left" : "right";
        }
        /** @type {string} */
        ee = location;
      }
      return ee;
    }
    /**
     * @return {undefined}
     */
    function install() {
      obj.browser = handler();
      obj.ie_version = getIE();
    }
    var location;
    return{
      /** @type {function (): undefined} */
      _init : install,
      /** @type {function (): ?} */
      isIOS : next,
      /** @type {function (): ?} */
      isAndroid : inspect,
      /** @type {function (): ?} */
      isBlackberry : check,
      /** @type {function (): ?} */
      isWindowsPhone : done,
      /** @type {function (): ?} */
      isMobile : exports,
      /** @type {function (): ?} */
      requestAnimationFrame : requestAnimationFrame,
      /** @type {function (?): ?} */
      getPX : cont,
      /** @type {function (): ?} */
      screenSize : get,
      /** @type {function (): ?} */
      isTouch : isTouch,
      /** @type {function (Text): ?} */
      sanitizeURL : trim,
      /** @type {function (boolean): ?} */
      isArray : _isArray,
      /** @type {function (string): ?} */
      RGBToHex : init,
      /** @type {function (string): ?} */
      HEXtoRGB : set,
      /** @type {function (string): ?} */
      isURL : compile,
      /** @type {function (Object): ?} */
      getAlignment : render
    };
  };
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.events = function(self) {
    /**
     * @param {?} obj
     * @param {string} func
     * @param {Function} f
     * @return {undefined}
     */
    function bind(obj, func, f) {
      obj.on(func.split(" ").join("." + self.id + " ") + "." + self.id, f);
      callback("destroy", function() {
        obj.off(func.split(" ").join("." + self.id + " ") + "." + self.id);
      });
    }
    /**
     * @return {undefined}
     */
    function replace() {
      bind(self.$el, "cut copy paste beforepaste", function(event) {
        trigger(event.type, [event]);
      });
    }
    /**
     * @return {undefined}
     */
    function create() {
      bind(self.$el, "click mouseup mousedown touchstart touchend dragenter dragover dragleave dragend drop", function(event) {
        trigger(event.type, [event]);
      });
    }
    /**
     * @return {undefined}
     */
    function bindToLoad() {
      bind(self.$el, "keydown keypress keyup input", function(event) {
        trigger(event.type, [event]);
      });
    }
    /**
     * @return {undefined}
     */
    function setup() {
      bind(self.$window, self._mousedown, function(dataAndEvents) {
        trigger("window.mousedown", [dataAndEvents]);
        next();
      });
      bind(self.$window, self._mouseup, function(dataAndEvents) {
        trigger("window.mouseup", [dataAndEvents]);
      });
      bind(self.$window, "keydown keyup touchmove", function(object) {
        trigger("window." + object.type, [object]);
      });
    }
    /**
     * @return {undefined}
     */
    function Init() {
      bind(self.$document, "drop", function(dataAndEvents) {
        trigger("document.drop", [dataAndEvents]);
      });
    }
    /**
     * @param {boolean} recurring
     * @return {?}
     */
    function toggle(recurring) {
      if ("undefined" == typeof recurring && (recurring = true), !self.$wp) {
        return false;
      }
      if (!self.core.hasFocus() && recurring) {
        return self.$el.focus(), false;
      }
      if (!self.core.hasFocus() || self.$el.find(".fr-marker").length > 0) {
        return false;
      }
      var br = self.selection.info(self.$el.get(0));
      if (br.atStart && (self.selection.isCollapsed() && null != self.html.defaultTag())) {
        var node = self.markers.insert();
        if (node && !self.node.blockParent(node)) {
          $(node).remove();
          var thead = self.$el.find(self.html.blockTagsQuery()).get(0);
          if (thead) {
            $(thead).prepend($.FroalaEditor.MARKERS);
            self.selection.restore();
          }
        } else {
          if (node) {
            $(node).remove();
          }
        }
      }
    }
    /**
     * @return {undefined}
     */
    function render() {
      bind(self.$el, "focus", function(event) {
        if (makeArray()) {
          toggle(false);
          if (y === false) {
            trigger(event.type, [event]);
          }
        }
      });
      bind(self.$el, "blur", function(event) {
        if (makeArray()) {
          if (y === true) {
            trigger(event.type, [event]);
          }
        }
      });
      callback("focus", function() {
        /** @type {boolean} */
        y = true;
      });
      callback("blur", function() {
        /** @type {boolean} */
        y = false;
      });
    }
    /**
     * @return {undefined}
     */
    function constructor() {
      if (self.helpers.isMobile()) {
        /** @type {string} */
        self._mousedown = "touchstart";
        /** @type {string} */
        self._mouseup = "touchend";
        /** @type {string} */
        self._move = "touchmove";
        /** @type {string} */
        self._mousemove = "touchmove";
      } else {
        /** @type {string} */
        self._mousedown = "mousedown";
        /** @type {string} */
        self._mouseup = "mouseup";
        /** @type {string} */
        self._move = "";
        /** @type {string} */
        self._mousemove = "mousemove";
      }
    }
    /**
     * @param {Event} e
     * @return {?}
     */
    function start(e) {
      var $target = $(e.currentTarget);
      return self.edit.isDisabled() || $target.hasClass("fr-disabled") ? (e.preventDefault(), false) : "mousedown" === e.type && 1 !== e.which ? true : (self.helpers.isMobile() || e.preventDefault(), (self.helpers.isAndroid() || self.helpers.isWindowsPhone()) && (0 === $target.parents(".fr-dropdown-menu").length && (e.preventDefault(), e.stopPropagation())), $target.addClass("fr-selected"), void self.events.trigger("commands.mousedown", [$target]));
    }
    /**
     * @param {Event} e
     * @param {Function} callback
     * @return {?}
     */
    function f(e, callback) {
      var input = $(e.currentTarget);
      if (self.edit.isDisabled() || input.hasClass("fr-disabled")) {
        return e.preventDefault(), false;
      }
      if ("mouseup" === e.type && 1 !== e.which) {
        return true;
      }
      if (!input.hasClass("fr-selected")) {
        return true;
      }
      if ("touchmove" != e.type) {
        if (e.stopPropagation(), e.stopImmediatePropagation(), e.preventDefault(), !input.hasClass("fr-selected")) {
          return $(".fr-selected").removeClass("fr-selected"), false;
        }
        if ($(".fr-selected").removeClass("fr-selected"), input.data("dragging") || input.attr("disabled")) {
          return input.removeData("dragging"), false;
        }
        var sleep = input.data("timeout");
        if (sleep) {
          clearTimeout(sleep);
          input.removeData("timeout");
        }
        callback.apply(self, [e]);
      } else {
        if (!input.data("timeout")) {
          input.data("timeout", setTimeout(function() {
            input.data("dragging", true);
          }, 100));
        }
      }
    }
    /**
     * @return {undefined}
     */
    function next() {
      /** @type {boolean} */
      ret = true;
    }
    /**
     * @return {undefined}
     */
    function disableBlur() {
      /** @type {boolean} */
      ret = false;
    }
    /**
     * @return {?}
     */
    function makeArray() {
      return ret;
    }
    /**
     * @param {Object} element
     * @param {?} toggle
     * @param {Function} method
     * @return {undefined}
     */
    function init(element, toggle, method) {
      element.on(self._mousedown, toggle, function(e) {
        start(e);
      });
      element.on(self._mouseup + " " + self._move, toggle, function(stream) {
        f(stream, method);
      });
      element.on("mousedown click mouseup", toggle, function(event) {
        event.stopPropagation();
      });
      callback("window.mouseup", function() {
        element.find(toggle).removeClass("fr-selected");
        next();
      });
      callback("destroy", function() {
        element.off(self._mousedown, toggle);
        element.off(self._mouseup + " " + self._move);
      });
    }
    /**
     * @param {string} type
     * @param {Function} name
     * @param {boolean} dataAndEvents
     * @return {undefined}
     */
    function callback(type, name, dataAndEvents) {
      if ("undefined" == typeof dataAndEvents) {
        /** @type {boolean} */
        dataAndEvents = false;
      }
      var exclude = map[type] = map[type] || [];
      if (dataAndEvents) {
        exclude.unshift(name);
      } else {
        exclude.push(name);
      }
    }
    /**
     * @param {string} eventName
     * @param {Array} params
     * @param {boolean} extra
     * @return {?}
     */
    function trigger(eventName, params, extra) {
      if (!self.edit.isDisabled() || extra) {
        var result;
        var handlers = map[eventName];
        if (handlers) {
          /** @type {number} */
          var i = 0;
          for (;i < handlers.length;i++) {
            if (result = handlers[i].apply(self, params), result === false) {
              return false;
            }
          }
        }
        return result = self.$original_element.triggerHandler("froalaEditor." + eventName, $.merge([self], params || [])), result === false ? false : result;
      }
    }
    /**
     * @param {string} e
     * @param {Node} input
     * @param {boolean} allBindingsAccessor
     * @return {?}
     */
    function update(e, input, allBindingsAccessor) {
      if (!self.edit.isDisabled() || allBindingsAccessor) {
        var text;
        var codeSegments = map[e];
        if (codeSegments) {
          /** @type {number} */
          var i = 0;
          for (;i < codeSegments.length;i++) {
            text = codeSegments[i].apply(self, [input]);
            if ("undefined" != typeof text) {
              input = text;
            }
          }
        }
        return text = self.$original_element.triggerHandler("froalaEditor." + e, $.merge([self], [input])), "undefined" != typeof text && (input = text), input;
      }
    }
    /**
     * @return {undefined}
     */
    function pkgs() {
      var letter;
      for (letter in map) {
        delete map[letter];
      }
    }
    /**
     * @return {undefined}
     */
    function add() {
      constructor();
      create();
      setup();
      Init();
      bindToLoad();
      render();
      next();
      replace();
      callback("destroy", pkgs);
    }
    var ret;
    var map = {};
    /** @type {boolean} */
    var y = false;
    return{
      /** @type {function (): undefined} */
      _init : add,
      /** @type {function (string, Function, boolean): undefined} */
      on : callback,
      /** @type {function (string, Array, boolean): ?} */
      trigger : trigger,
      /** @type {function (Object, ?, Function): undefined} */
      bindClick : init,
      /** @type {function (): undefined} */
      disableBlur : disableBlur,
      /** @type {function (): undefined} */
      enableBlur : next,
      /** @type {function (): ?} */
      blurActive : makeArray,
      /** @type {function (boolean): ?} */
      focus : toggle,
      /** @type {function (string, Node, boolean): ?} */
      chainTrigger : update
    };
  };
  /** @type {string} */
  $.FroalaEditor.INVISIBLE_SPACE = "&#8203;";
  /** @type {string} */
  $.FroalaEditor.START_MARKER = '<span class="fr-marker" data-id="0" data-type="true" style="display: none; line-height: 0;">' + $.FroalaEditor.INVISIBLE_SPACE + "</span>";
  /** @type {string} */
  $.FroalaEditor.END_MARKER = '<span class="fr-marker" data-id="0" data-type="false" style="display: none; line-height: 0;">' + $.FroalaEditor.INVISIBLE_SPACE + "</span>";
  /** @type {string} */
  $.FroalaEditor.MARKERS = $.FroalaEditor.START_MARKER + $.FroalaEditor.END_MARKER;
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.markers = function(self) {
    /**
     * @param {string} tagName
     * @param {number} state
     * @return {?}
     */
    function init(tagName, state) {
      return $('<span class="fr-marker" data-id="' + state + '" data-type="' + tagName + '" style="display: ' + (self.browser.safari ? "none" : "inline-block") + '; line-height: 0;">' + $.FroalaEditor.INVISIBLE_SPACE + "</span>", self.document)[0];
    }
    /**
     * @param {Object} obj
     * @param {Object} el
     * @param {number} doc
     * @return {?}
     */
    function set(obj, el, doc) {
      try {
        var range = obj.cloneRange();
        if (range.collapse(el), range.insertNode(init(el, doc)), el === true && obj.collapsed) {
          var node = self.$el.find('span.fr-marker[data-type="true"][data-id="' + doc + '"]').get(0).nextSibling;
          for (;node && (node.nodeType === Node.TEXT_NODE && 0 === node.textContent.length);) {
            $(node).remove();
            node = self.$el.find('span.fr-marker[data-type="true"][data-id="' + doc + '"]').get(0).nextSibling;
          }
        }
        if (el === true && !obj.collapsed) {
          el = self.$el.find('span.fr-marker[data-type="true"][data-id="' + doc + '"]').get(0);
          node = el.nextSibling;
          if (node && (node.nodeType === Node.ELEMENT_NODE && self.node.isBlock(node))) {
            /** @type {Array} */
            var nodes = [node];
            do {
              node = nodes[0];
              nodes = self.node.contents(node);
            } while (nodes[0] && self.node.isBlock(nodes[0]));
            $(node).prepend($(el));
          }
        }
        if (el === false && !obj.collapsed) {
          el = self.$el.find('span.fr-marker[data-type="false"][data-id="' + doc + '"]').get(0);
          node = el.previousSibling;
          if (node && (node.nodeType === Node.ELEMENT_NODE && self.node.isBlock(node))) {
            /** @type {Array} */
            nodes = [node];
            do {
              node = nodes[nodes.length - 1];
              nodes = self.node.contents(node);
            } while (nodes[nodes.length - 1] && self.node.isBlock(nodes[nodes.length - 1]));
            $(node).append($(el));
          }
          if (el.parentNode) {
            if (["TD", "TH"].indexOf(el.parentNode.tagName) >= 0) {
              if (el.parentNode.previousSibling) {
                if (!el.previousSibling) {
                  $(el.parentNode.previousSibling).append(el);
                }
              }
            }
          }
        }
        return el;
      } catch (j) {
        return null;
      }
    }
    /**
     * @return {?}
     */
    function parse() {
      if (!self.$wp) {
        return null;
      }
      try {
        var range = self.selection.ranges(0);
        var sel = range.commonAncestorContainer;
        if (sel != self.$el.get(0) && 0 == self.$el.find(sel).length) {
          return null;
        }
        var clone1 = range.cloneRange();
        var r2 = range.cloneRange();
        clone1.collapse(true);
        var child = $('<span class="fr-marker" style="display: none; line-height: 0;">' + $.FroalaEditor.INVISIBLE_SPACE + "</span>", self.document)[0];
        if (clone1.insertNode(child), child = self.$el.find("span.fr-marker").get(0)) {
          var node = child.nextSibling;
          for (;node && (node.nodeType === Node.TEXT_NODE && 0 === node.textContent.length);) {
            $(node).remove();
            node = self.$el.find("span.fr-marker").get(0).nextSibling;
          }
          return self.selection.clear(), self.selection.get().addRange(r2), child;
        }
        return null;
      } catch (i) {
      }
    }
    /**
     * @param {Event} e
     * @return {undefined}
     */
    function select(e) {
      var x = e.clientX;
      var y = e.clientY;
      removeClass();
      var ref;
      /** @type {null} */
      var range = null;
      if ("undefined" != typeof self.document.caretPositionFromPoint ? (ref = self.document.caretPositionFromPoint(x, y), range = self.document.createRange(), range.setStart(ref.offsetNode, ref.offset), range.setEnd(ref.offsetNode, ref.offset)) : "undefined" != typeof self.document.caretRangeFromPoint && (ref = self.document.caretRangeFromPoint(x, y), range = self.document.createRange(), range.setStart(ref.startContainer, ref.startOffset), range.setEnd(ref.startContainer, ref.startOffset)), null !== 
      range && "undefined" != typeof self.window.getSelection) {
        var selection = self.window.getSelection();
        selection.removeAllRanges();
        selection.addRange(range);
      } else {
        if ("undefined" != typeof self.document.body.createTextRange) {
          try {
            range = self.document.body.createTextRange();
            range.moveToPoint(x, y);
            var rangeEnd = range.duplicate();
            rangeEnd.moveToPoint(x, y);
            range.setEndPoint("EndToEnd", rangeEnd);
            range.select();
          } catch (k) {
          }
        }
      }
      parse();
    }
    /**
     * @return {undefined}
     */
    function removeClass() {
      self.$el.find(".fr-marker").remove();
    }
    return{
      /** @type {function (Object, Object, number): ?} */
      place : set,
      /** @type {function (): ?} */
      insert : parse,
      /** @type {function (Event): undefined} */
      insertAtPoint : select,
      /** @type {function (): undefined} */
      remove : removeClass
    };
  };
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.selection = function(self) {
    /**
     * @return {?}
     */
    function insert() {
      /** @type {string} */
      var text = "";
      return self.window.getSelection ? text = self.window.getSelection() : self.document.getSelection ? text = self.document.getSelection() : self.document.selection && (text = self.document.selection.createRange().text), text.toString();
    }
    /**
     * @return {?}
     */
    function get() {
      /** @type {string} */
      var optsData = "";
      return optsData = self.window.getSelection ? self.window.getSelection() : self.document.getSelection ? self.document.getSelection() : self.document.selection.createRange();
    }
    /**
     * @param {number} mayParseLabeledStatementInstead
     * @return {?}
     */
    function start(mayParseLabeledStatementInstead) {
      var selection = get();
      /** @type {Array} */
      var colNames = [];
      if (selection && (selection.getRangeAt && selection.rangeCount)) {
        /** @type {Array} */
        colNames = [];
        /** @type {number} */
        var i = 0;
        for (;i < selection.rangeCount;i++) {
          colNames.push(selection.getRangeAt(i));
        }
      } else {
        /** @type {Array} */
        colNames = self.document.createRange ? [self.document.createRange()] : [];
      }
      return "undefined" != typeof mayParseLabeledStatementInstead ? colNames[mayParseLabeledStatementInstead] : colNames;
    }
    /**
     * @return {undefined}
     */
    function clear() {
      var selection = get();
      try {
        if (selection.removeAllRanges) {
          selection.removeAllRanges();
        } else {
          if (selection.empty) {
            selection.empty();
          } else {
            if (selection.clear) {
              selection.clear();
            }
          }
        }
      } catch (b) {
      }
    }
    /**
     * @return {?}
     */
    function walk() {
      var selection = get();
      try {
        if (selection.rangeCount) {
          var obj = start(0);
          var node = obj.startContainer;
          if (node.nodeType == Node.ELEMENT_NODE) {
            /** @type {boolean} */
            var i = false;
            if (node.childNodes.length > 0 && node.childNodes[obj.startOffset]) {
              var parent = node.childNodes[obj.startOffset];
              for (;parent && (parent.nodeType == Node.TEXT_NODE && 0 == parent.textContent.length);) {
                parent = parent.nextSibling;
              }
              if (parent) {
                if (parent.textContent.replace(/\u200B/g, "") === insert().replace(/\u200B/g, "")) {
                  node = parent;
                  /** @type {boolean} */
                  i = true;
                }
              }
            } else {
              if (!obj.collapsed && (node.nextSibling && node.nextSibling.nodeType == Node.ELEMENT_NODE)) {
                parent = node.nextSibling;
                if (parent) {
                  if (parent.textContent.replace(/\u200B/g, "") === insert().replace(/\u200B/g, "")) {
                    node = parent;
                    /** @type {boolean} */
                    i = true;
                  }
                }
              }
            }
            if (!i) {
              if (node.childNodes.length > 0) {
                if ($(node.childNodes[0]).text().replace(/\u200B/g, "") === insert().replace(/\u200B/g, "")) {
                  if (["BR", "IMG", "HR"].indexOf(node.childNodes[0].tagName) < 0) {
                    node = node.childNodes[0];
                  }
                }
              }
            }
          }
          for (;node.nodeType != Node.ELEMENT_NODE && node.parentNode;) {
            node = node.parentNode;
          }
          var current = node;
          for (;current && "HTML" != current.tagName;) {
            if (current == self.$el.get(0)) {
              return node;
            }
            current = $(current).parent()[0];
          }
        }
      } catch (l) {
      }
      return self.$el.get(0);
    }
    /**
     * @return {?}
     */
    function set() {
      var selection = get();
      try {
        if (selection.rangeCount) {
          var obj = start(0);
          var node = obj.endContainer;
          if (node.nodeType == Node.ELEMENT_NODE) {
            /** @type {boolean} */
            var i = false;
            if (node.childNodes.length > 0 && (node.childNodes[obj.endOffset] && $(node.childNodes[obj.endOffset]).text() === insert())) {
              node = node.childNodes[obj.endOffset];
              /** @type {boolean} */
              i = true;
            } else {
              if (!obj.collapsed && (node.previousSibling && node.previousSibling.nodeType == Node.ELEMENT_NODE)) {
                var container = node.previousSibling;
                if (container) {
                  if (container.textContent.replace(/\u200B/g, "") === insert().replace(/\u200B/g, "")) {
                    node = container;
                    /** @type {boolean} */
                    i = true;
                  }
                }
              }
            }
            if (!i) {
              if (node.childNodes.length > 0) {
                if ($(node.childNodes[node.childNodes.length - 1]).text() === insert()) {
                  if (["BR", "IMG", "HR"].indexOf(node.childNodes[node.childNodes.length - 1].tagName) < 0) {
                    node = node.childNodes[node.childNodes.length - 1];
                  }
                }
              }
            }
          }
          if (node.nodeType == Node.TEXT_NODE) {
            if (0 == obj.endOffset) {
              if (node.previousSibling) {
                if (node.previousSibling.nodeType == Node.ELEMENT_NODE) {
                  node = node.previousSibling;
                }
              }
            }
          }
          for (;node.nodeType != Node.ELEMENT_NODE && node.parentNode;) {
            node = node.parentNode;
          }
          var current = node;
          for (;current && "HTML" != current.tagName;) {
            if (current == self.$el.get(0)) {
              return node;
            }
            current = $(current).parent()[0];
          }
        }
      } catch (l) {
      }
      return self.$el.get(0);
    }
    /**
     * @param {?} any
     * @param {?} offset
     * @return {?}
     */
    function innerNode(any, offset) {
      var node = any;
      return node.nodeType == Node.ELEMENT_NODE && (node.childNodes.length > 0 && (node.childNodes[offset] && (node = node.childNodes[offset]))), node.nodeType == Node.TEXT_NODE && (node = node.parentNode), node;
    }
    /**
     * @return {?}
     */
    function f() {
      /** @type {Array} */
      var nodes = [];
      var selection = get();
      if (update() && selection.rangeCount) {
        var codeSegments = start();
        /** @type {number} */
        var i = 0;
        for (;i < codeSegments.length;i++) {
          var range = codeSegments[i];
          var block = innerNode(range.startContainer, range.startOffset);
          var item = innerNode(range.endContainer, range.endOffset);
          if (self.node.isBlock(block)) {
            if (nodes.indexOf(block) < 0) {
              nodes.push(block);
            }
          }
          var text = self.node.blockParent(block);
          if (text) {
            if (nodes.indexOf(text) < 0) {
              nodes.push(text);
            }
          }
          /** @type {Array} */
          var ancestors = [];
          var node = block;
          for (;node !== item && node !== self.$el.get(0);) {
            if (ancestors.indexOf(node) < 0 && (node.children && node.children.length)) {
              ancestors.push(node);
              node = node.children[0];
            } else {
              if (node.nextSibling) {
                node = node.nextSibling;
              } else {
                if (node.parentNode) {
                  node = node.parentNode;
                  ancestors.push(node);
                }
              }
            }
            if (self.node.isBlock(node)) {
              if (ancestors.indexOf(node) < 0) {
                if (nodes.indexOf(node) < 0) {
                  nodes.push(node);
                }
              }
            }
          }
          if (self.node.isBlock(item)) {
            if (nodes.indexOf(item) < 0) {
              nodes.push(item);
            }
          }
          text = self.node.blockParent(item);
          if (text) {
            if (nodes.indexOf(text) < 0) {
              nodes.push(text);
            }
          }
        }
      }
      /** @type {number} */
      i = nodes.length - 1;
      for (;i > 0;i--) {
        if ($(nodes[i]).find(nodes).length) {
          if ("LI" != nodes[i].tagName) {
            nodes.splice(i, 1);
          }
        }
      }
      return nodes;
    }
    /**
     * @return {undefined}
     */
    function init() {
      if (self.$wp) {
        self.markers.remove();
        var comparisons = start();
        /** @type {Array} */
        var codeSegments = [];
        /** @type {number} */
        var i = 0;
        for (;i < comparisons.length;i++) {
          if (comparisons[i].startContainer !== self.document) {
            var t = comparisons[i];
            var sibling = t.collapsed;
            var ret = self.markers.place(t, true, i);
            var end = self.markers.place(t, false, i);
            if (self.browser.safari && !sibling) {
              t = self.document.createRange();
              t.setStartAfter(ret);
              t.setEndBefore(end);
              codeSegments.push(t);
            }
          }
        }
        if (self.browser.safari && codeSegments.length) {
          self.selection.clear();
          /** @type {number} */
          i = 0;
          for (;i < codeSegments.length;i++) {
            self.selection.get().addRange(codeSegments[i]);
          }
        }
      }
    }
    /**
     * @return {?}
     */
    function initialize() {
      var tags = self.$el.find('.fr-marker[data-type="true"]');
      if (!self.$wp) {
        return tags.remove(), false;
      }
      if (0 === tags.length) {
        return false;
      }
      if (!self.core.hasFocus()) {
        if (!self.browser.msie) {
          if (!self.browser.webkit) {
            self.$el.focus();
          }
        }
      }
      clear();
      var selection = get();
      /** @type {number} */
      var i = 0;
      for (;i < tags.length;i++) {
        var targetNode = $(tags[i]).data("id");
        var elem = tags[i];
        var range = self.document.createRange();
        var element = self.$el.find('.fr-marker[data-type="false"][data-id="' + targetNode + '"]');
        /** @type {null} */
        var $child = null;
        if (element.length > 0) {
          element = element[0];
          try {
            /** @type {boolean} */
            var n = false;
            var parent = elem.nextSibling;
            for (;parent && (parent.nodeType == Node.TEXT_NODE && 0 == parent.textContent.length);) {
              var container = parent;
              parent = parent.nextSibling;
              $(container).remove();
            }
            var sibling = element.nextSibling;
            for (;sibling && (sibling.nodeType == Node.TEXT_NODE && 0 == sibling.textContent.length);) {
              container = sibling;
              sibling = sibling.nextSibling;
              $(container).remove();
            }
            if (elem.nextSibling == element || element.nextSibling == elem) {
              var dom = elem.nextSibling == element ? elem : element;
              var me = dom == elem ? element : elem;
              var node = dom.previousSibling;
              for (;node && (node.nodeType == Node.TEXT_NODE && 0 == node.length);) {
                container = node;
                node = node.previousSibling;
                $(container).remove();
              }
              if (node && node.nodeType == Node.TEXT_NODE) {
                for (;node && (node.previousSibling && node.previousSibling.nodeType == Node.TEXT_NODE);) {
                  node.previousSibling.textContent = node.previousSibling.textContent + node.textContent;
                  node = node.previousSibling;
                  $(node.nextSibling).remove();
                }
              }
              var el = me.nextSibling;
              for (;el && (el.nodeType == Node.TEXT_NODE && 0 == el.length);) {
                container = el;
                el = el.nextSibling;
                $(container).remove();
              }
              if (el && el.nodeType == Node.TEXT_NODE) {
                for (;el && (el.nextSibling && el.nextSibling.nodeType == Node.TEXT_NODE);) {
                  el.nextSibling.textContent = el.textContent + el.nextSibling.textContent;
                  el = el.nextSibling;
                  $(el.previousSibling).remove();
                }
              }
              if (node && (self.node.isVoid(node) && (node = null)), el && (self.node.isVoid(el) && (el = null)), node && (el && (node.nodeType == Node.TEXT_NODE && el.nodeType == Node.TEXT_NODE))) {
                $(elem).remove();
                $(element).remove();
                var endIndex = node.textContent.length;
                node.textContent = node.textContent + el.textContent;
                $(el).remove();
                self.html.normalizeSpaces(node);
                range.setStart(node, endIndex);
                range.setEnd(node, endIndex);
                /** @type {boolean} */
                n = true;
              } else {
                if (!node && (el && el.nodeType == Node.TEXT_NODE)) {
                  $(elem).remove();
                  $(element).remove();
                  self.html.normalizeSpaces(el);
                  $child = $(self.document.createTextNode("\u200b"));
                  $(el).before($child);
                  range.setStart(el, 0);
                  range.setEnd(el, 0);
                  /** @type {boolean} */
                  n = true;
                } else {
                  if (!el) {
                    if (node) {
                      if (node.nodeType == Node.TEXT_NODE) {
                        $(elem).remove();
                        $(element).remove();
                        self.html.normalizeSpaces(node);
                        $child = $(self.document.createTextNode("\u200b"));
                        $(node).after($child);
                        range.setStart(node, node.textContent.length);
                        range.setEnd(node, node.textContent.length);
                        /** @type {boolean} */
                        n = true;
                      }
                    }
                  }
                }
              }
            }
            if (!n) {
              var val;
              var update;
              if (self.browser.chrome && elem.nextSibling == element) {
                val = getText(element, range, true) || range.setStartAfter(element);
                update = getText(elem, range, false) || range.setEndBefore(elem);
              } else {
                if (elem.previousSibling == element) {
                  elem = element;
                  element = elem.nextSibling;
                }
                if (!(element.nextSibling && "BR" === element.nextSibling.tagName)) {
                  if (!(!element.nextSibling && self.node.isBlock(elem.previousSibling))) {
                    if (!(elem.previousSibling && "BR" == elem.previousSibling.tagName)) {
                      /** @type {string} */
                      elem.style.display = "inline";
                      /** @type {string} */
                      element.style.display = "inline";
                      $child = $(self.document.createTextNode("\u200b"));
                    }
                  }
                }
                val = getText(elem, range, true) || $(elem).before($child) && range.setStartBefore(elem);
                update = getText(element, range, false) || $(element).after($child) && range.setEndAfter(element);
              }
              if ("function" == typeof val) {
                val();
              }
              if ("function" == typeof update) {
                update();
              }
            }
          } catch (y) {
          }
        }
        if ($child) {
          $child.remove();
        }
        selection.addRange(range);
      }
      self.markers.remove();
    }
    /**
     * @param {Node} el
     * @param {?} range
     * @param {boolean} recurring
     * @return {?}
     */
    function getText(el, range, recurring) {
      var node = el.previousSibling;
      var container = el.nextSibling;
      if (node && (container && (node.nodeType == Node.TEXT_NODE && container.nodeType == Node.TEXT_NODE))) {
        var endIndex = node.textContent.length;
        return recurring ? (container.textContent = node.textContent + container.textContent, $(node).remove(), $(el).remove(), self.html.normalizeSpaces(container), function() {
          range.setStart(container, endIndex);
        }) : (node.textContent = node.textContent + container.textContent, $(container).remove(), $(el).remove(), self.html.normalizeSpaces(node), function() {
          range.setEnd(node, endIndex);
        });
      }
      if (node && (!container && node.nodeType == Node.TEXT_NODE)) {
        endIndex = node.textContent.length;
        return recurring ? (self.html.normalizeSpaces(node), function() {
          range.setStart(node, endIndex);
        }) : (self.html.normalizeSpaces(node), function() {
          range.setEnd(node, endIndex);
        });
      }
      return container && (!node && container.nodeType == Node.TEXT_NODE) ? recurring ? (self.html.normalizeSpaces(container), function() {
        range.setStart(container, 0);
      }) : (self.html.normalizeSpaces(container), function() {
        range.setEnd(container, 0);
      }) : false;
    }
    /**
     * @return {?}
     */
    function isWhitespace() {
      return true;
    }
    /**
     * @return {?}
     */
    function expand() {
      var codeSegments = start();
      /** @type {number} */
      var i = 0;
      for (;i < codeSegments.length;i++) {
        if (!codeSegments[i].collapsed) {
          return false;
        }
      }
      return true;
    }
    /**
     * @param {?} node
     * @return {?}
     */
    function getSelection(node) {
      var constraint;
      var rng;
      /** @type {boolean} */
      var atStart = false;
      /** @type {boolean} */
      var atEnd = false;
      if (self.window.getSelection) {
        var sel = self.window.getSelection();
        if (sel.rangeCount) {
          constraint = sel.getRangeAt(0);
          rng = constraint.cloneRange();
          rng.selectNodeContents(node);
          rng.setEnd(constraint.startContainer, constraint.startOffset);
          /** @type {boolean} */
          atStart = "" === rng.toString();
          rng.selectNodeContents(node);
          rng.setStart(constraint.endContainer, constraint.endOffset);
          /** @type {boolean} */
          atEnd = "" === rng.toString();
        }
      } else {
        if (self.document.selection) {
          if ("Control" != self.document.selection.type) {
            constraint = self.document.selection.createRange();
            rng = constraint.duplicate();
            rng.moveToElementText(node);
            rng.setEndPoint("EndToStart", constraint);
            /** @type {boolean} */
            atStart = "" === rng.text;
            rng.moveToElementText(node);
            rng.setEndPoint("StartToEnd", constraint);
            /** @type {boolean} */
            atEnd = "" === rng.text;
          }
        }
      }
      return{
        atStart : atStart,
        atEnd : atEnd
      };
    }
    /**
     * @return {?}
     */
    function render() {
      if (expand()) {
        return false;
      }
      self.$el.find("td").prepend('<span class="fr-mk">' + $.FroalaEditor.INVISIBLE_SPACE + "</span>");
      self.$el.find("img").append('<span class="fr-mk">' + $.FroalaEditor.INVISIBLE_SPACE + "</span>");
      /** @type {boolean} */
      var atEnd = false;
      var br = getSelection(self.$el.get(0));
      return br.atStart && (br.atEnd && (atEnd = true)), self.$el.find(".fr-mk").remove(), atEnd;
    }
    /**
     * @param {Node} node
     * @param {boolean} last
     * @return {undefined}
     */
    function process(node, last) {
      if ("undefined" == typeof last) {
        /** @type {boolean} */
        last = true;
      }
      var vals = $(node).html();
      if (vals) {
        if (vals.replace(/\u200b/g, "").length != vals.length) {
          $(node).html(vals.replace(/\u200b/g, ""));
        }
      }
      var children = self.node.contents(node);
      /** @type {number} */
      var i = 0;
      for (;i < children.length;i++) {
        if (children[i].nodeType != Node.ELEMENT_NODE) {
          $(children[i]).remove();
        } else {
          process(children[i], 0 == i);
          if (0 == i) {
            /** @type {boolean} */
            last = false;
          }
        }
      }
      if (node.nodeType == Node.TEXT_NODE) {
        $(node).replaceWith('<span data-first="true" data-text="true"></span>');
      } else {
        if (last) {
          $(node).attr("data-first", true);
        }
      }
    }
    /**
     * @param {HTMLElement} component
     * @param {number} doc
     * @return {?}
     */
    function load(component, doc) {
      var codeSegments = self.node.contents(component.get(0));
      if (["TD", "TH"].indexOf(component.get(0).tagName) >= 0) {
        if (1 == component.find(".fr-marker").length) {
          if ($(codeSegments[0]).hasClass("fr-marker")) {
            component.attr("data-del-cell", true);
          }
        }
      }
      /** @type {number} */
      var i = 0;
      for (;i < codeSegments.length;i++) {
        var val = codeSegments[i];
        if ($(val).hasClass("fr-marker")) {
          /** @type {number} */
          doc = (doc + 1) % 2;
        } else {
          if (doc) {
            if ($(val).find(".fr-marker").length > 0) {
              doc = load($(val), doc);
            } else {
              if (["TD", "TH"].indexOf(val.tagName) < 0 && !$(val).hasClass("fr-inner")) {
                if (!self.opts.keepFormatOnDelete || (doc > 1 || self.$el.find("[data-first]").length > 0)) {
                  $(val).remove();
                } else {
                  process(val);
                }
              } else {
                if ($(val).hasClass("fr-inner")) {
                  if (0 == $(val).find(".fr-inner").length) {
                    $(val).html("<br>");
                  } else {
                    $(val).find(".fr-inner").filter(function() {
                      return 0 == $(this).find("fr-inner").length;
                    }).html("<br>");
                  }
                } else {
                  $(val).empty();
                  $(val).attr("data-del-cell", true);
                }
              }
            }
          } else {
            if ($(val).find(".fr-marker").length > 0) {
              doc = load($(val), doc);
            }
          }
        }
      }
      return doc;
    }
    /**
     * @return {?}
     */
    function update() {
      try {
        if (!self.$wp) {
          return false;
        }
        var range = start(0);
        var current = range.commonAncestorContainer;
        for (;current && !self.node.isElement(current);) {
          current = current.parentNode;
        }
        return self.node.isElement(current) ? true : false;
      } catch (d) {
        return false;
      }
    }
    /**
     * @return {undefined}
     */
    function parse() {
      init();
      /**
       * @param {Element} container
       * @return {?}
       */
      var save = function(container) {
        var node = container.previousSibling;
        for (;node && (node.nodeType == Node.TEXT_NODE && 0 == node.textContent.length);) {
          var next = node;
          node = node.previousSibling;
          $(next).remove();
        }
        return node;
      };
      /**
       * @param {(Array|Element)} target
       * @return {?}
       */
      var parse = function(target) {
        var node = target.nextSibling;
        for (;node && (node.nodeType == Node.TEXT_NODE && 0 == node.textContent.length);) {
          var next = node;
          node = node.nextSibling;
          $(next).remove();
        }
        return node;
      };
      var nodes = self.$el.find('.fr-marker[data-type="true"]');
      /** @type {number} */
      var i = 0;
      for (;i < nodes.length;i++) {
        var root = nodes[i];
        for (;!save(root) && !self.node.isBlock(root.parentNode);) {
          $(root.parentNode).before(root);
        }
      }
      var codeSegments = self.$el.find('.fr-marker[data-type="false"]');
      /** @type {number} */
      i = 0;
      for (;i < codeSegments.length;i++) {
        var base = codeSegments[i];
        for (;!parse(base) && !self.node.isBlock(base.parentNode);) {
          $(base.parentNode).after(base);
        }
      }
      if (isWhitespace()) {
        load(self.$el, 0);
        var el = self.$el.find('[data-first="true"]');
        if (el.length) {
          self.$el.find(".fr-marker").remove();
          el.append($.FroalaEditor.INVISIBLE_SPACE + $.FroalaEditor.MARKERS).removeAttr("data-first");
          if (el.attr("data-text")) {
            el.replaceWith(el.html());
          }
        } else {
          self.$el.find("table").filter(function() {
            /** @type {boolean} */
            var obj = $(this).find("[data-del-cell]").length > 0 && $(this).find("[data-del-cell]").length == $(this).find("td, th").length;
            return obj;
          }).remove();
          self.$el.find("[data-del-cell]").removeAttr("data-del-cell");
          nodes = self.$el.find('.fr-marker[data-type="true"]');
          /** @type {number} */
          i = 0;
          for (;i < nodes.length;i++) {
            var node = nodes[i];
            var child = node.nextSibling;
            var block = self.$el.find('.fr-marker[data-type="false"][data-id="' + $(node).data("id") + '"]').get(0);
            if (block) {
              if (child && child == block) {
              } else {
                if (node) {
                  var current = self.node.blockParent(node);
                  var last = self.node.blockParent(block);
                  if ($(node).after(block), current == last) {
                  } else {
                    if (null == current) {
                      var next = self.node.deepestParent(node);
                      if (next) {
                        $(next).after($(last).html());
                        $(last).remove();
                      } else {
                        if (0 == $(last).parentsUntil(self.$el, "table").length) {
                          $(node).next().after($(last).html());
                          $(last).remove();
                        }
                      }
                    } else {
                      if (null == last && 0 == $(current).parentsUntil(self.$el, "table").length) {
                        child = current;
                        for (;!child.nextSibling && child.parentNode != self.$el.get(0);) {
                          child = child.parentNode;
                        }
                        child = child.nextSibling;
                        for (;child && "BR" != child.tagName;) {
                          var nextChild = child.nextSibling;
                          $(current).append(child);
                          child = nextChild;
                        }
                      } else {
                        if (0 == $(current).parentsUntil(self.$el, "table").length) {
                          if (0 == $(last).parentsUntil(self.$el, "table").length) {
                            $(current).append($(last).html());
                            $(last).remove();
                          }
                        }
                      }
                    }
                  }
                }
              }
            } else {
              block = $(node).clone().attr("data-type", false);
              $(node).after(block);
            }
          }
        }
      }
      if (!self.opts.keepFormatOnDelete) {
        self.html.fillEmptyBlocks(true);
      }
      self.html.cleanEmptyTags(true);
      self.clean.lists();
      self.html.normalizeSpaces();
      initialize();
    }
    /**
     * @param {(RegExp|string)} node
     * @return {?}
     */
    function animate(node) {
      if ($(node).find(".fr-marker").length > 0) {
        return false;
      }
      var nodes = self.node.contents(node);
      for (;nodes.length && self.node.isBlock(nodes[0]);) {
        node = nodes[0];
        nodes = self.node.contents(node);
      }
      $(node).prepend($.FroalaEditor.MARKERS);
    }
    /**
     * @param {(RegExp|string)} node
     * @return {?}
     */
    function wrap(node) {
      if ($(node).find(".fr-marker").length > 0) {
        return false;
      }
      var nodes = self.node.contents(node);
      for (;nodes.length && self.node.isBlock(nodes[nodes.length - 1]);) {
        node = nodes[nodes.length - 1];
        nodes = self.node.contents(node);
      }
      $(node).append($.FroalaEditor.MARKERS);
    }
    /**
     * @param {Element} target
     * @return {?}
     */
    function select(target) {
      var node = target.previousSibling;
      for (;node && (node.nodeType == Node.TEXT_NODE && 0 == node.textContent.length);) {
        node = node.previousSibling;
      }
      return node ? (self.node.isBlock(node) ? wrap(node) : "BR" == node.tagName ? $(node).before($.FroalaEditor.MARKERS) : $(node).after($.FroalaEditor.MARKERS), true) : false;
    }
    /**
     * @param {(Array|Element)} end
     * @return {?}
     */
    function tick(end) {
      var node = end.nextSibling;
      for (;node && (node.nodeType == Node.TEXT_NODE && 0 == node.textContent.length);) {
        node = node.nextSibling;
      }
      return node ? (self.node.isBlock(node) ? animate(node) : $(node).before($.FroalaEditor.MARKERS), true) : false;
    }
    return{
      /** @type {function (): ?} */
      text : insert,
      /** @type {function (): ?} */
      get : get,
      /** @type {function (number): ?} */
      ranges : start,
      /** @type {function (): undefined} */
      clear : clear,
      /** @type {function (): ?} */
      element : walk,
      /** @type {function (): ?} */
      endElement : set,
      /** @type {function (): undefined} */
      save : init,
      /** @type {function (): ?} */
      restore : initialize,
      /** @type {function (): ?} */
      isCollapsed : expand,
      /** @type {function (): ?} */
      isFull : render,
      /** @type {function (): ?} */
      inEditor : update,
      /** @type {function (): undefined} */
      remove : parse,
      /** @type {function (): ?} */
      blocks : f,
      /** @type {function (?): ?} */
      info : getSelection,
      /** @type {function ((RegExp|string)): ?} */
      setAtEnd : wrap,
      /** @type {function ((RegExp|string)): ?} */
      setAtStart : animate,
      /** @type {function (Element): ?} */
      setBefore : select,
      /** @type {function ((Array|Element)): ?} */
      setAfter : tick,
      /** @type {function (?, ?): ?} */
      rangeElement : innerNode
    };
  };
  /** @type {string} */
  $.FroalaEditor.UNICODE_NBSP = String.fromCharCode(160);
  /** @type {Array} */
  $.FroalaEditor.VOID_ELEMENTS = ["area", "base", "br", "col", "embed", "hr", "img", "input", "keygen", "link", "menuitem", "meta", "param", "source", "track", "wbr"];
  /** @type {Array} */
  $.FroalaEditor.BLOCK_TAGS = ["p", "div", "h1", "h2", "h3", "h4", "h5", "h6", "pre", "blockquote", "ul", "ol", "li", "table", "td", "th", "thead", "tfoot", "tbody", "tr", "hr", "dl", "dt", "dd"];
  $.extend($.FroalaEditor.DEFAULTS, {
    htmlAllowedEmptyTags : ["textarea", "a", "iframe", "object", "video", "style", "script", ".fa"],
    htmlSimpleAmpersand : false
  });
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.html = function(self) {
    /**
     * @return {?}
     */
    function getFixBodyTag() {
      return self.opts.enter == $.FroalaEditor.ENTER_P ? "p" : self.opts.enter == $.FroalaEditor.ENTER_DIV ? "div" : self.opts.enter == $.FroalaEditor.ENTER_BR ? null : void 0;
    }
    /**
     * @param {boolean} deepDataAndEvents
     * @return {?}
     */
    function check(deepDataAndEvents) {
      if ("undefined" == typeof deepDataAndEvents) {
        /** @type {boolean} */
        deepDataAndEvents = false;
      }
      var arr;
      var i;
      /** @type {Array} */
      var value = [];
      if (deepDataAndEvents) {
        arr = self.$el.find(execute());
        /** @type {number} */
        i = 0;
        for (;i < arr.length;i++) {
          var content = self.node.contents(arr[i]);
          /** @type {boolean} */
          var j = false;
          /** @type {number} */
          var n = 0;
          for (;n < content.length;n++) {
            if (content[n].nodeType != Node.COMMENT_NODE && (content[n].nodeType == Node.ELEMENT_NODE && $.FroalaEditor.VOID_ELEMENTS.indexOf(content[n].tagName.toLowerCase()) >= 0 || content[n].textContent && content[n].textContent.replace(/\u200B/g, "").length > 0)) {
              /** @type {boolean} */
              j = true;
              break;
            }
          }
          if (!j) {
            if (!(0 !== $(arr[i]).find(execute()).length)) {
              value.push(arr[i]);
            }
          }
        }
      } else {
        arr = self.$el.find(updateElement());
        /** @type {number} */
        i = 0;
        for (;i < arr.length;i++) {
          if (0 === $(arr[i]).find(execute()).length) {
            value.push(arr[i]);
          }
        }
      }
      return $($.makeArray(value));
    }
    /**
     * @return {?}
     */
    function updateElement() {
      return $.FroalaEditor.BLOCK_TAGS.join(":empty, ") + ":empty";
    }
    /**
     * @return {?}
     */
    function execute() {
      return $.FroalaEditor.BLOCK_TAGS.join(", ");
    }
    /**
     * @return {undefined}
     */
    function render() {
      var markers = $.merge(["TD", "TH"], $.FroalaEditor.VOID_ELEMENTS);
      markers = $.merge(markers, self.opts.htmlAllowedEmptyTags);
      var nodes;
      var nodeIndexOutOfRange;
      do {
        /** @type {boolean} */
        nodeIndexOutOfRange = false;
        nodes = self.$el.find("*:empty").not(markers.join(", ") + ", .fr-marker");
        /** @type {number} */
        var i = 0;
        for (;i < nodes.length;i++) {
          if (0 === nodes[i].attributes.length || "undefined" != typeof nodes[i].getAttribute("href")) {
            $(nodes[i]).remove();
            /** @type {boolean} */
            nodeIndexOutOfRange = true;
          }
        }
        nodes = self.$el.find("*:empty").not(markers.join(", ") + ", .fr-marker");
      } while (nodes.length && nodeIndexOutOfRange);
    }
    /**
     * @param {Node} controller
     * @param {boolean} deepDataAndEvents
     * @return {undefined}
     */
    function postLink(controller, deepDataAndEvents) {
      var num = getFixBodyTag();
      if (deepDataAndEvents && (num = 'div class="fr-temp-div"'), num) {
        var minArray = self.node.contents(controller.get(0));
        /** @type {null} */
        var el = null;
        /** @type {number} */
        var itemIndex = 0;
        for (;itemIndex < minArray.length;itemIndex++) {
          var node = minArray[itemIndex];
          if (node.nodeType == Node.ELEMENT_NODE && self.node.isBlock(node)) {
            /** @type {null} */
            el = null;
          } else {
            if (node.nodeType != Node.ELEMENT_NODE && node.nodeType != Node.TEXT_NODE) {
              /** @type {null} */
              el = null;
            } else {
              if (node.nodeType == Node.ELEMENT_NODE && "BR" == node.tagName) {
                if (null == el) {
                  if (deepDataAndEvents) {
                    $(node).replaceWith("<" + num + ' data-empty="true"><br></div>');
                  } else {
                    $(node).replaceWith("<" + num + "><br></" + num + ">");
                  }
                } else {
                  $(node).remove();
                  var children = self.node.contents(el);
                  /** @type {boolean} */
                  var l = false;
                  /** @type {number} */
                  var i = 0;
                  for (;i < children.length;i++) {
                    if (!$(children[i]).hasClass("fr-marker") && (children[i].nodeType != Node.TEXT_NODE || 0 !== children[i].textContent.replace(/ /g, "").length)) {
                      /** @type {boolean} */
                      l = true;
                      break;
                    }
                  }
                  if (l === false) {
                    el.append("<br>");
                    el.data("empty", true);
                  }
                  /** @type {null} */
                  el = null;
                }
              } else {
                if (node.nodeType == Node.TEXT_NODE && 0 == $(node).text().trim().length) {
                  $(node).remove();
                } else {
                  if (null == el) {
                    el = $("<" + num + ">");
                    $(node).before(el);
                  }
                  if (node.nodeType == Node.TEXT_NODE && $(node).text().trim().length > 0) {
                    el.append($(node).clone());
                    $(node).remove();
                  } else {
                    el.append($(node));
                  }
                }
              }
            }
          }
        }
      }
    }
    /**
     * @param {boolean} deepDataAndEvents
     * @param {boolean} size
     * @param {boolean} tag
     * @return {?}
     */
    function wrap(deepDataAndEvents, size, tag) {
      return self.$wp ? ("undefined" == typeof deepDataAndEvents && (deepDataAndEvents = false), "undefined" == typeof size && (size = false), "undefined" == typeof tag && (tag = false), postLink(self.$el, deepDataAndEvents), self.$el.find(".fr-inner").each(function() {
        postLink($(this), deepDataAndEvents);
      }), size && self.$el.find("td, th").each(function() {
        postLink($(this), deepDataAndEvents);
      }), void(tag && self.$el.find("blockquote").each(function() {
        postLink($(this), deepDataAndEvents);
      }))) : false;
    }
    /**
     * @return {undefined}
     */
    function init() {
      self.$el.find("div.fr-temp-div").each(function() {
        if ($(this).data("empty") || "LI" == this.parentNode.tagName) {
          $(this).replaceWith($(this).html());
        } else {
          $(this).replaceWith($(this).html() + "<br>");
        }
      });
      self.$el.find(".fr-temp-div").removeClass("fr-temp-div").filter(function() {
        return "" == $(this).attr("class");
      }).removeAttr("class");
    }
    /**
     * @param {boolean} deepDataAndEvents
     * @return {undefined}
     */
    function load(deepDataAndEvents) {
      check(deepDataAndEvents).not("hr").filter(function() {
        return "false" != $(this).attr("contenteditable") && 0 == $(this).find("br").length;
      }).append("<br/>");
    }
    /**
     * @return {?}
     */
    function onload() {
      return self.$el.find(execute());
    }
    /**
     * @param {(RegExp|string)} node
     * @return {undefined}
     */
    function create(node) {
      if ("undefined" == typeof node) {
        node = self.$el.get(0);
      }
      var nodes = self.node.contents(node);
      /** @type {number} */
      var i = nodes.length - 1;
      for (;i >= 0;i--) {
        if (nodes[i].nodeType == Node.TEXT_NODE && self.node.isBlock(node)) {
          /** @type {number} */
          var currentTouches = -1;
          for (;currentTouches != nodes[i].textContent.length;) {
            currentTouches = nodes[i].textContent.length;
            nodes[i].textContent = nodes[i].textContent.replace(/(?!^)  (?!$)/g, " ");
          }
          nodes[i].textContent = nodes[i].textContent.replace(/^  /g, " ");
          nodes[i].textContent = nodes[i].textContent.replace(/  $/g, " ");
          if (self.node.isBlock(node)) {
            if (!nodes[i].previousSibling) {
              nodes[i].textContent = nodes[i].textContent.replace(/^ */, "");
            }
            if (!nodes[i].nextSibling) {
              nodes[i].textContent = nodes[i].textContent.replace(/ *$/, "");
            }
          }
        } else {
          create(nodes[i]);
        }
      }
    }
    /**
     * @param {?} node
     * @return {?}
     */
    function walk(node) {
      return node && (self.node.isBlock(node) || (["STYLE", "SCRIPT", "HEAD", "BR", "HR"].indexOf(node.tagName) >= 0 || node.nodeType == Node.COMMENT_NODE));
    }
    /**
     * @param {Node} node
     * @return {undefined}
     */
    function remove(node) {
      if ("undefined" == typeof node && (node = self.$el.get(0)), node.nodeType == Node.ELEMENT_NODE && ["STYLE", "SCRIPT", "HEAD"].indexOf(node.tagName) < 0) {
        var children = self.node.contents(node);
        /** @type {number} */
        var pos = children.length - 1;
        for (;pos >= 0;pos--) {
          if (!$(children[pos]).hasClass("fr-marker")) {
            remove(children[pos]);
          }
        }
      } else {
        if (node.nodeType == Node.TEXT_NODE && node.textContent.length > 0) {
          var child = node.previousSibling;
          var nextNode = node.nextSibling;
          if (walk(child) && (walk(nextNode) && 0 === node.textContent.trim().length)) {
            $(node).remove();
          } else {
            var template = node.textContent;
            template = template.replace(new RegExp($.FroalaEditor.UNICODE_NBSP, "g"), " ");
            /** @type {string} */
            var text = "";
            /** @type {number} */
            var i = 0;
            for (;i < template.length;i++) {
              text += 32 != template.charCodeAt(i) || 0 !== i && 32 != text.charCodeAt(i - 1) ? template[i] : $.FroalaEditor.UNICODE_NBSP;
            }
            if (!node.nextSibling) {
              text = text.replace(/ $/, $.FroalaEditor.UNICODE_NBSP);
            }
            if (node.previousSibling) {
              if (!self.node.isVoid(node.previousSibling)) {
                text = text.replace(/^\u00A0([^ $])/, " $1");
              }
            }
            text = text.replace(/([^ \u00A0])\u00A0([^ \u00A0])/g, "$1 $2");
            if (node.textContent != text) {
              node.textContent = text;
            }
          }
        }
      }
    }
    /**
     * @param {Node} node
     * @return {?}
     */
    function parse(node) {
      if ("undefined" == typeof node && (node = self.$el.get(0)), node.nodeType == Node.ELEMENT_NODE && ["STYLE", "SCRIPT", "HEAD"].indexOf(node.tagName) < 0) {
        var children = self.node.contents(node);
        /** @type {number} */
        var item = children.length - 1;
        for (;item >= 0;item--) {
          if (!$(children[item]).hasClass("fr-marker")) {
            var url = parse(children[item]);
            if (1 == url) {
              return true;
            }
          }
        }
      } else {
        if (node.nodeType == Node.TEXT_NODE && node.textContent.length > 0) {
          var child = node.previousSibling;
          var nextNode = node.nextSibling;
          if (walk(child) && (walk(nextNode) && 0 === node.textContent.trim().length)) {
            return true;
          }
          var template = node.textContent;
          template = template.replace(new RegExp($.FroalaEditor.UNICODE_NBSP, "g"), " ");
          /** @type {string} */
          var text = "";
          /** @type {number} */
          var i = 0;
          for (;i < template.length;i++) {
            text += 32 != template.charCodeAt(i) || 0 !== i && 32 != text.charCodeAt(i - 1) ? template[i] : $.FroalaEditor.UNICODE_NBSP;
          }
          if (node.nextSibling || (text = text.replace(/ $/, $.FroalaEditor.UNICODE_NBSP)), node.previousSibling && (!self.node.isVoid(node.previousSibling) && (text = text.replace(/^\u00A0([^ $])/, " $1"))), text = text.replace(/([^ \u00A0])\u00A0([^ \u00A0])/g, "$1 $2"), node.textContent != text) {
            return true;
          }
        }
      }
      return false;
    }
    /**
     * @param {string} value
     * @param {string} code
     * @param {number} property
     * @return {?}
     */
    function getValue(value, code, property) {
      /** @type {RegExp} */
      var r = new RegExp(code, "gi");
      /** @type {(Array.<string>|null)} */
      var offset = r.exec(value);
      return offset ? offset[property] : null;
    }
    /**
     * @param {string} k
     * @param {Object} result
     * @return {?}
     */
    function next(k, result) {
      var token = k.match(/<!DOCTYPE ?([^ ]*) ?([^ ]*) ?"?([^"]*)"? ?"?([^"]*)"?>/i);
      return token ? result.implementation.createDocumentType(token[1], token[3], token[4]) : result.implementation.createDocumentType("html");
    }
    /**
     * @param {?} doc
     * @return {?}
     */
    function fn(doc) {
      var doctype = doc.doctype;
      /** @type {string} */
      var c = "<!DOCTYPE html>";
      return doctype && (c = "<!DOCTYPE " + doctype.name + (doctype.publicId ? ' PUBLIC "' + doctype.publicId + '"' : "") + (!doctype.publicId && doctype.systemId ? " SYSTEM" : "") + (doctype.systemId ? ' "' + doctype.systemId + '"' : "") + ">"), c;
    }
    /**
     * @return {undefined}
     */
    function add() {
      wrap();
      create();
      render();
      remove();
      load(true);
      self.clean.quotes();
      self.clean.lists();
      self.clean.tables();
      self.clean.toHTML5();
      self.clean.quotes();
      self.placeholder.refresh();
      self.selection.restore();
      update();
    }
    /**
     * @return {undefined}
     */
    function update() {
      if (self.core.isEmpty()) {
        if (null != getFixBodyTag()) {
          if (0 === self.$el.find(execute()).length) {
            if (self.core.hasFocus()) {
              self.$el.html("<" + getFixBodyTag() + ">" + $.FroalaEditor.MARKERS + "<br/></" + getFixBodyTag() + ">");
              self.selection.restore();
            } else {
              self.$el.html("<" + getFixBodyTag() + "><br/></" + getFixBodyTag() + ">");
            }
          }
        } else {
          if (0 === self.$el.find("*:not(.fr-marker):not(br)").length) {
            if (self.core.hasFocus()) {
              self.$el.html($.FroalaEditor.MARKERS + "<br/>");
              self.selection.restore();
            } else {
              self.$el.html("<br/>");
            }
          }
        }
      }
    }
    /**
     * @param {string} entry
     * @param {string} data
     * @return {?}
     */
    function success(entry, data) {
      return getValue(entry, "<" + data + "[^>]*?>([\\w\\W]*)</" + data + ">", 1);
    }
    /**
     * @param {string} data
     * @param {string} arr
     * @return {?}
     */
    function callback(data, arr) {
      var cl = $("<div " + (getValue(data, "<" + arr + "([^>]*?)>", 1) || "") + ">");
      return self.node.rawAttributes(cl.get(0));
    }
    /**
     * @param {string} value
     * @return {?}
     */
    function lookupIterator(value) {
      return getValue(value, "<!DOCTYPE([^>]*?)>", 0) || "<!DOCTYPE html>";
    }
    /**
     * @param {string} object
     * @return {undefined}
     */
    function set(object) {
      var value = self.clean.html(object, [], [], self.opts.fullPage);
      if (value = value.replace(/\r|\n/g, ""), self.opts.fullPage) {
        var right = (success(value, "body") || value).replace(/\r|\n/g, "");
        var current = callback(value, "body");
        var m = success(value, "head") || "<title></title>";
        var val = callback(value, "head");
        var element = lookupIterator(value);
        var wrapper = callback(value, "html");
        self.$el.html(right);
        self.node.clearAttributes(self.$el.get(0));
        self.$el.attr(current);
        self.$head.html(m);
        self.node.clearAttributes(self.$head.get(0));
        self.$head.attr(val);
        self.node.clearAttributes(self.$html.get(0));
        self.$html.attr(wrapper);
        self.iframe_document.doctype.parentNode.replaceChild(next(element, self.iframe_document), self.iframe_document.doctype);
      } else {
        self.$el.html(value);
      }
      self.edit.on();
      self.core.injectStyle(self.opts.iframeStyle);
      add();
      self.$el.find("[fr-original-class]").each(function() {
        this.setAttribute("class", this.getAttribute("fr-original-class"));
        this.removeAttribute("fr-original-class");
      });
      self.$el.find("[fr-original-style]").each(function() {
        this.setAttribute("style", this.getAttribute("fr-original-style"));
        this.removeAttribute("fr-original-style");
      });
      self.events.trigger("html.set");
    }
    /**
     * @param {number} mayParseLabeledStatementInstead
     * @param {boolean} dataAndEvents
     * @return {?}
     */
    function run(mayParseLabeledStatementInstead, dataAndEvents) {
      /** @type {string} */
      var string = "";
      self.events.trigger("html.beforeGet");
      var j;
      /** @type {Array} */
      var nodes = [];
      if (!self.opts.useClasses && !dataAndEvents) {
        /** @type {number} */
        j = 0;
        for (;j < self.document.styleSheets.length;j++) {
          var rules;
          try {
            rules = self.document.styleSheets[j].cssRules;
          } catch (h) {
          }
          if (rules) {
            /** @type {number} */
            var x = 0;
            var len = rules.length;
            for (;len > x;x++) {
              /** @type {string} */
              var currDirRegExp = self.opts.iframe ? "body " : ".fr-view ";
              if (rules[x].selectorText && (0 === rules[x].selectorText.indexOf(currDirRegExp) && rules[x].style.cssText.length > 0)) {
                var selector = rules[x].selectorText.replace(currDirRegExp, "").replace(/::/g, ":");
                var els = self.$el.get(0).querySelectorAll(selector);
                /** @type {number} */
                var i = 0;
                for (;i < els.length;i++) {
                  if (!els[i].getAttribute("fr-original-style")) {
                    if (els[i].getAttribute("style")) {
                      els[i].setAttribute("fr-original-style", els[i].getAttribute("style"));
                      nodes.push(els[i]);
                    }
                  }
                  var parameters = rules[x].style.cssText.split(";");
                  /** @type {number} */
                  var p = 0;
                  for (;p < parameters.length;p++) {
                    var att = parameters[p].trim().split(":")[0];
                    els[i].style[att] = self.window.getComputedStyle(els[i], null).getPropertyValue(att);
                  }
                }
              }
            }
          }
        }
        /** @type {number} */
        j = 0;
        for (;j < nodes.length;j++) {
          if (nodes[j].getAttribute("class")) {
            nodes[j].setAttribute("fr-original-class", nodes[j].getAttribute("class"));
            nodes[j].removeAttribute("class");
          }
        }
      }
      if (self.core.isEmpty() ? self.opts.fullPage && (string = fn(self.iframe_document), string += "<html" + self.node.attributes(self.$html.get(0)) + ">" + self.$html.html() + "</html>") : ("undefined" == typeof mayParseLabeledStatementInstead && (mayParseLabeledStatementInstead = false), self.opts.fullPage ? (string = fn(self.iframe_document), string += "<html" + self.node.attributes(self.$html.get(0)) + ">" + self.$html.html() + "</html>") : string = self.$el.html()), !self.opts.useClasses && 
      !dataAndEvents) {
        /** @type {number} */
        j = 0;
        for (;j < nodes.length;j++) {
          if (nodes[j].getAttribute("fr-original-class")) {
            nodes[j].setAttribute("class", nodes[j].getAttribute("fr-original-class"));
            nodes[j].removeAttribute("fr-original-class");
          }
          nodes[j].setAttribute("style", nodes[j].getAttribute("fr-original-style"));
          nodes[j].removeAttribute("fr-original-style");
        }
      }
      /** @type {string} */
      string = string.replace(/<pre(?:[\w\W]*?)>(?:[\w\W]*?)<\/pre>/g, function(messageFormat) {
        return messageFormat.replace(/<br>/g, "\n");
      });
      if (self.opts.fullPage) {
        /** @type {string} */
        string = string.replace(/<style data-fr-style="true">(?:[\w\W]*?)<\/style>/g, "");
        /** @type {string} */
        string = string.replace(/<style(?:[\w\W]*?)class="firebugResetStyles"(?:[\w\W]*?)>(?:[\w\W]*?)<\/style>/g, "");
        /** @type {string} */
        string = string.replace(/<body((?:[\w\W]*?)) spellcheck="true"((?:[\w\W]*?))>((?:[\w\W]*?))<\/body>/g, "<body$1$2>$3</body>");
        /** @type {string} */
        string = string.replace(/<body((?:[\w\W]*?)) contenteditable="(true|false)"((?:[\w\W]*?))>((?:[\w\W]*?))<\/body>/g, "<body$1$3>$4</body>");
        /** @type {string} */
        string = string.replace(/<body((?:[\w\W]*?)) dir="([\w]*)"((?:[\w\W]*?))>((?:[\w\W]*?))<\/body>/g, "<body$1$3>$4</body>");
        /** @type {string} */
        string = string.replace(/<body((?:[\w\W]*?))class="([\w\W]*?)(fr-rtl|fr-ltr)([\w\W]*?)"((?:[\w\W]*?))>((?:[\w\W]*?))<\/body>/g, '<body$1class="$2$4"$5>$6</body>');
        /** @type {string} */
        string = string.replace(/<body((?:[\w\W]*?)) class=""((?:[\w\W]*?))>((?:[\w\W]*?))<\/body>/g, "<body$1$2>$3</body>");
      }
      if (self.opts.htmlSimpleAmpersand) {
        /** @type {string} */
        string = string.replace(/\&amp;/gi, "&");
      }
      self.events.trigger("html.afterGet");
      if (!mayParseLabeledStatementInstead) {
        /** @type {string} */
        string = string.replace(/<span[^>]*? class\s*=\s*["']?fr-marker["']?[^>]+>\u200b<\/span>/gi, "");
      }
      string = self.clean.invisibleSpaces(string);
      var err = self.events.chainTrigger("html.get", string);
      return "string" == typeof err && (string = err), string;
    }
    /**
     * @return {?}
     */
    function initialize() {
      /**
       * @param {Element} element
       * @param {Element} node
       * @return {undefined}
       */
      var remove = function(element, node) {
        for (;node && (node.nodeType == Node.TEXT_NODE || !self.node.isBlock(node));) {
          if (node) {
            if (node.nodeType != Node.TEXT_NODE) {
              $(element).wrapInner(self.node.openTagString(node) + self.node.closeTagString(node));
            }
          }
          node = node.parentNode;
        }
        if (node) {
          if (element.innerHTML == node.innerHTML) {
            element.innerHTML = node.outerHTML;
          }
        }
      };
      /**
       * @return {?}
       */
      var init = function() {
        var selection;
        /** @type {null} */
        var node = null;
        return self.window.getSelection ? (selection = self.window.getSelection(), selection && (selection.rangeCount && (node = selection.getRangeAt(0).commonAncestorContainer, node.nodeType != Node.ELEMENT_NODE && (node = node.parentNode)))) : (selection = self.document.selection) && ("Control" != selection.type && (node = selection.createRange().parentElement())), null != node && ($.inArray(self.$el.get(0), $(node).parents()) >= 0 || node == self.$el.get(0)) ? node : null;
      };
      /** @type {string} */
      var html = "";
      if ("undefined" != typeof self.window.getSelection) {
        if (self.browser.mozilla) {
          self.selection.save();
          if (self.$el.find('.fr-marker[data-type="false"]').length > 1) {
            self.$el.find('.fr-marker[data-type="false"][data-id="0"]').remove();
            self.$el.find('.fr-marker[data-type="false"]:last').attr("data-id", "0");
            self.$el.find(".fr-marker").not('[data-id="0"]').remove();
          }
          self.selection.restore();
        }
        var codeSegments = self.selection.ranges();
        /** @type {number} */
        var i = 0;
        for (;i < codeSegments.length;i++) {
          /** @type {Element} */
          var element = document.createElement("div");
          element.appendChild(codeSegments[i].cloneContents());
          remove(element, init());
          if ($(element).find(".fr-element").length > 0) {
            element = self.$el.get(0);
          }
          html += element.innerHTML;
        }
      } else {
        if ("undefined" != typeof self.document.selection) {
          if ("Text" == self.document.selection.type) {
            html = self.document.selection.createRange().htmlText;
          }
        }
      }
      return html;
    }
    /**
     * @param {string} options
     * @return {?}
     */
    function destroy(options) {
      var scope = $("<div>").html(options);
      return scope.find(execute()).length > 0;
    }
    /**
     * @param {string} str
     * @return {?}
     */
    function start(str) {
      var container = self.document.createElement("div");
      return container.innerHTML = str, self.selection.setAtEnd(container), container.innerHTML;
    }
    /**
     * @param {string} val
     * @return {?}
     */
    function encodeUriSegment(val) {
      return val.replace(/</gi, "&lt;").replace(/>/gi, "&gt;").replace(/"/gi, "&quot;").replace(/'/gi, "&apos;");
    }
    /**
     * @param {string} data
     * @param {boolean} isArray
     * @return {undefined}
     */
    function done(data, isArray) {
      if ("" !== self.selection.text()) {
        self.selection.remove();
      }
      var id;
      if (id = isArray ? data : self.clean.html(data), data.indexOf('class="fr-marker"') < 0 && (id = start(id)), self.core.isEmpty()) {
        self.$el.html(id);
      } else {
        self.markers.insert();
        var node;
        var list = self.$el.find(".fr-marker").get(0);
        if (destroy(id) && (node = self.node.deepestParent(list))) {
          if (self.node.isBlock(node) && self.node.isEmpty(node)) {
            $(node).replaceWith(id);
          } else {
            var cur = list;
            /** @type {string} */
            var ns = "";
            /** @type {string} */
            var name = "";
            do {
              cur = cur.parentNode;
              ns += self.node.closeTagString(cur);
              name = self.node.openTagString(cur) + name;
            } while (cur != node);
            $(list).replaceWith('<span id="fr-break"></span>');
            var line = self.node.openTagString(node) + $(node).html() + self.node.closeTagString(node);
            line = line.replace(/<span id="fr-break"><\/span>/g, ns + id + name);
            $(node).replaceWith(line);
          }
        } else {
          $(list).replaceWith(id);
        }
      }
      add();
      self.events.trigger("html.inserted");
    }
    /**
     * @param {?} index
     * @return {undefined}
     */
    function get(index) {
      /** @type {null} */
      var $enabledFields = null;
      if ("undefined" == typeof index) {
        $enabledFields = self.selection.element();
      }
      var drop;
      var f;
      do {
        /** @type {boolean} */
        f = false;
        drop = self.$el.find("*").not($enabledFields).not(".fr-marker");
        /** @type {number} */
        var i = 0;
        for (;i < drop.length;i++) {
          var item = drop.get(i);
          var value = item.textContent;
          if (0 === $(item).find("*").length) {
            if (1 === value.length) {
              if (8203 == value.charCodeAt(0)) {
                $(item).remove();
                /** @type {boolean} */
                f = true;
              }
            }
          }
        }
      } while (f);
    }
    /**
     * @return {undefined}
     */
    function addListeners() {
      /**
       * @return {undefined}
       */
      var open = function() {
        get();
        if (self.placeholder) {
          self.placeholder.refresh();
        }
      };
      self.events.on("mouseup", open);
      self.events.on("keydown", open);
      self.events.on("contentChanged", update);
    }
    return{
      /** @type {function (): ?} */
      defaultTag : getFixBodyTag,
      /** @type {function (boolean): ?} */
      emptyBlocks : check,
      /** @type {function (): ?} */
      emptyBlockTagsQuery : updateElement,
      /** @type {function (): ?} */
      blockTagsQuery : execute,
      /** @type {function (boolean): undefined} */
      fillEmptyBlocks : load,
      /** @type {function (): undefined} */
      cleanEmptyTags : render,
      /** @type {function (?): undefined} */
      cleanWhiteTags : get,
      /** @type {function (Node): undefined} */
      normalizeSpaces : remove,
      /** @type {function (Node): ?} */
      doNormalize : parse,
      /** @type {function ((RegExp|string)): undefined} */
      cleanBlankSpaces : create,
      /** @type {function (): ?} */
      blocks : onload,
      /** @type {function (?): ?} */
      getDoctype : fn,
      /** @type {function (string): undefined} */
      set : set,
      /** @type {function (number, boolean): ?} */
      get : run,
      /** @type {function (): ?} */
      getSelected : initialize,
      /** @type {function (string, boolean): undefined} */
      insert : done,
      /** @type {function (boolean, boolean, boolean): ?} */
      wrap : wrap,
      /** @type {function (): undefined} */
      unwrap : init,
      /** @type {function (string): ?} */
      escapeEntities : encodeUriSegment,
      /** @type {function (): undefined} */
      checkIfEmpty : update,
      /** @type {function (string, string): ?} */
      extractNode : success,
      /** @type {function (string, string): ?} */
      extractNodeAttrs : callback,
      /** @type {function (string): ?} */
      extractDoctype : lookupIterator,
      /** @type {function (): undefined} */
      _init : addListeners
    };
  };
  $.extend($.FroalaEditor.DEFAULTS, {
    height : null,
    heightMax : null,
    heightMin : null,
    width : null
  });
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.size = function(self) {
    /**
     * @return {undefined}
     */
    function initialize() {
      if (self.opts.height) {
        self.$el.css("minHeight", self.opts.height - self.helpers.getPX(self.$el.css("padding-top")) - self.helpers.getPX(self.$el.css("padding-bottom")));
      }
      self.$iframe.height(self.$el.outerHeight(true));
    }
    /**
     * @return {undefined}
     */
    function render() {
      if (self.opts.height) {
        self.$wp.height(self.opts.height);
        self.$el.css("minHeight", self.opts.height - self.helpers.getPX(self.$el.css("padding-top")) - self.helpers.getPX(self.$el.css("padding-bottom")));
      }
      if (self.opts.heightMin) {
        self.$el.css("minHeight", self.opts.heightMin);
      }
      if (self.opts.heightMax) {
        self.$wp.css("maxHeight", self.opts.heightMax);
      }
      if (self.opts.width) {
        self.$box.width(self.opts.width);
      }
    }
    /**
     * @return {?}
     */
    function init() {
      return self.$wp ? (render(), void(self.opts.iframe && (self.events.on("keyup", initialize), self.events.on("commands.after", initialize), self.events.on("html.set", initialize), self.events.on("init", initialize), self.events.on("initialized", initialize)))) : false;
    }
    return{
      /** @type {function (): ?} */
      _init : init,
      /** @type {function (): undefined} */
      syncIframe : initialize,
      /** @type {function (): undefined} */
      refresh : render
    };
  };
  $.extend($.FroalaEditor.DEFAULTS, {
    language : null
  });
  $.FroalaEditor.LANGUAGE = {};
  /**
   * @param {Object} data
   * @return {?}
   */
  $.FroalaEditor.MODULES.language = function(data) {
    /**
     * @param {string} name
     * @return {?}
     */
    function attr(name) {
      return params && params.translation[name] ? params.translation[name] : name;
    }
    /**
     * @return {undefined}
     */
    function initContacts() {
      if ($.FroalaEditor.LANGUAGE) {
        params = $.FroalaEditor.LANGUAGE[data.opts.language];
      }
      if (params) {
        if (params.direction) {
          data.opts.direction = params.direction;
        }
      }
    }
    var params;
    return{
      /** @type {function (): undefined} */
      _init : initContacts,
      /** @type {function (string): ?} */
      translate : attr
    };
  };
  $.extend($.FroalaEditor.DEFAULTS, {
    placeholderText : "Type something",
    placeholderFontFamily : "Arial, Helvetica, sans-serif"
  });
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.placeholder = function(self) {
    /**
     * @return {undefined}
     */
    function init() {
      /** @type {number} */
      var fontSize = 0;
      var all = self.node.contents(self.$el.get(0));
      if (all.length && all[0].nodeType == Node.ELEMENT_NODE) {
        fontSize = self.helpers.getPX($(all[0]).css("margin-top"));
        self.$placeholder.css("font-size", $(all[0]).css("font-size"));
        self.$placeholder.css("line-height", $(all[0]).css("line-height"));
      } else {
        self.$placeholder.css("font-size", self.$el.css("font-size"));
        self.$placeholder.css("line-height", self.$el.css("line-height"));
      }
      self.$wp.addClass("show-placeholder");
      self.$placeholder.css("margin-top", fontSize).text(self.language.translate(self.opts.placeholderText || (self.$original_element.attr("placeholder") || "")));
    }
    /**
     * @return {undefined}
     */
    function hide() {
      self.$wp.removeClass("show-placeholder");
    }
    /**
     * @return {?}
     */
    function addClass() {
      return self.$wp ? self.$wp.hasClass("show-placeholder") : true;
    }
    /**
     * @return {?}
     */
    function show() {
      return self.$wp ? void(self.core.isEmpty() ? init() : hide()) : false;
    }
    /**
     * @return {?}
     */
    function update() {
      return self.$wp ? (self.$placeholder = $('<span class="fr-placeholder"></span>'), self.$wp.append(self.$placeholder), self.events.on("init", show), self.events.on("input", show), self.events.on("keydown", show), self.events.on("keyup", show), void self.events.on("contentChanged", show)) : false;
    }
    return{
      /** @type {function (): ?} */
      _init : update,
      /** @type {function (): undefined} */
      show : init,
      /** @type {function (): undefined} */
      hide : hide,
      /** @type {function (): ?} */
      refresh : show,
      /** @type {function (): ?} */
      isVisible : addClass
    };
  };
  /**
   * @param {Object} $
   * @return {?}
   */
  $.FroalaEditor.MODULES.edit = function($) {
    /**
     * @return {undefined}
     */
    function onDomReady() {
      if ($.browser.mozilla) {
        $.document.execCommand("enableObjectResizing", false, "false");
        $.document.execCommand("enableInlineTableEditing", false, "false");
      }
    }
    /**
     * @return {undefined}
     */
    function Editor() {
      if ($.$wp) {
        $.$el.attr("contenteditable", true);
        $.$el.removeClass("fr-disabled");
        if ($.$tb) {
          $.$tb.removeClass("fr-disabled");
        }
        onDomReady();
      }
      /** @type {boolean} */
      event = false;
    }
    /**
     * @return {undefined}
     */
    function init() {
      if ($.$wp) {
        $.$el.attr("contenteditable", false);
        $.$el.addClass("fr-disabled");
        $.$tb.addClass("fr-disabled");
      }
      /** @type {boolean} */
      event = true;
    }
    /**
     * @return {?}
     */
    function filter() {
      return event;
    }
    /** @type {boolean} */
    var event = false;
    return{
      /** @type {function (): undefined} */
      on : Editor,
      /** @type {function (): undefined} */
      off : init,
      /** @type {function (): undefined} */
      disableDesign : onDomReady,
      /** @type {function (): ?} */
      isDisabled : filter
    };
  };
  $.extend($.FroalaEditor.DEFAULTS, {
    editorClass : null,
    typingTimer : 500,
    iframe : false,
    requestWithCORS : true,
    requestHeaders : {},
    useClasses : true,
    spellcheck : true,
    iframeStyle : 'html{margin: 0px;}body{padding:10px;background:transparent;color:#000000;position:relative;z-index: 2;-webkit-user-select:auto;margin:0px;overflow:hidden;}body:after{content:"";clear:both;display:block}',
    direction : "auto",
    zIndex : 1,
    disableRightClick : false,
    scrollableContainer : "body",
    keepFormatOnDelete : false
  });
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.core = function(self) {
    /**
     * @param {string} textStatus
     * @return {undefined}
     */
    function error(textStatus) {
      if (self.opts.iframe) {
        self.$head.append('<style data-fr-style="true">' + textStatus + "</style>");
      }
    }
    /**
     * @return {undefined}
     */
    function callback() {
      if (!self.opts.iframe) {
        self.$el.addClass("fr-element fr-view");
      }
    }
    /**
     * @return {undefined}
     */
    function draw() {
      if (self.$box.addClass("fr-box" + (self.opts.editorClass ? " " + self.opts.editorClass : "")), self.$wp.addClass("fr-wrapper"), callback(), self.opts.iframe) {
        self.$iframe.addClass("fr-iframe");
        /** @type {number} */
        var i = 0;
        for (;i < self.original_document.styleSheets.length;i++) {
          var rules;
          try {
            rules = self.original_document.styleSheets[i].cssRules;
          } catch (e) {
          }
          if (rules) {
            /** @type {number} */
            var x = 0;
            var len = rules.length;
            for (;len > x;x++) {
              if (rules[x].selectorText) {
                if (0 === rules[x].selectorText.indexOf(".fr-view")) {
                  if (rules[x].style.cssText.length > 0) {
                    self.opts.iframeStyle += rules[x].selectorText.replace(/\.fr-view/g, "body") + "{" + rules[x].style.cssText + "}";
                  }
                }
              }
            }
          }
        }
      }
      if ("auto" != self.opts.direction) {
        self.$box.removeClass("fr-ltr fr-rtl").addClass("fr-" + self.opts.direction);
      }
      self.$el.attr("dir", self.opts.direction);
      self.$wp.attr("dir", self.opts.direction);
      if (self.opts.zIndex > 1) {
        self.$box.css("z-index", self.opts.zIndex);
      }
      if (self.$box) {
        if (self.opts.theme) {
          self.$box.addClass(self.opts.theme + "-theme");
        }
      }
    }
    /**
     * @return {?}
     */
    function isEmpty() {
      return self.node.isEmpty(self.$el.get(0));
    }
    /**
     * @return {undefined}
     */
    function initialize() {
      self.drag_support = {
        filereader : "undefined" != typeof FileReader,
        formdata : !!self.window.FormData,
        progress : "upload" in new XMLHttpRequest
      };
    }
    /**
     * @param {?} url
     * @param {?} method
     * @return {?}
     */
    function send(url, method) {
      /** @type {XMLHttpRequest} */
      var xhr = new XMLHttpRequest;
      xhr.open(method, url, true);
      if (self.opts.requestWithCORS) {
        /** @type {boolean} */
        xhr.withCredentials = true;
      }
      var header;
      for (header in self.opts.requestHeaders) {
        xhr.setRequestHeader(header, self.opts.requestHeaders[header]);
      }
      return xhr;
    }
    /**
     * @return {undefined}
     */
    function render() {
      if ("TEXTAREA" == self.$original_element.get(0).tagName) {
        self.$original_element.val(self.html.get());
      }
      if (self.$wp) {
        if ("TEXTAREA" == self.$original_element.get(0).tagName) {
          self.$box.replaceWith(self.$original_element);
          self.$original_element.show();
        } else {
          self.$el.off("contextmenu.rightClick");
          self.$wp.replaceWith(self.html.get());
          self.$box.removeClass("fr-view fr-ltr fr-box " + (self.opts.editorClass || ""));
          if (self.opts.theme) {
            self.$box.addClass(self.opts.theme + "-theme");
          }
        }
      }
    }
    /**
     * @return {?}
     */
    function Text() {
      return self.node.hasFocus(self.$el.get(0));
    }
    /**
     * @return {undefined}
     */
    function init() {
      if ($.FroalaEditor.INSTANCES.push(self), initialize(), self.$wp) {
        draw();
        self.html.set(self._original_html);
        self.$el.attr("spellcheck", self.opts.spellcheck);
        if (self.helpers.isMobile()) {
          self.$el.attr("autocomplete", self.opts.spellcheck ? "on" : "off");
          self.$el.attr("autocorrect", self.opts.spellcheck ? "on" : "off");
          self.$el.attr("autocapitalize", self.opts.spellcheck ? "on" : "off");
        }
        if (self.opts.disableRightClick) {
          self.$el.on("contextmenu.rightClick", function(e) {
            return 2 == e.button ? false : void 0;
          });
        }
        try {
          self.document.execCommand("styleWithCSS", false, false);
        } catch (c) {
        }
      }
      self.events.trigger("init");
      self.events.on("destroy", render);
      if ("TEXTAREA" == self.$original_element.get(0).tagName) {
        self.events.on("contentChanged", function() {
          self.$original_element.val(self.html.get());
        });
        self.events.on("form.submit", function() {
          self.$original_element.val(self.html.get());
        });
        self.$original_element.val(self.html.get());
      }
    }
    return{
      /** @type {function (): undefined} */
      _init : init,
      /** @type {function (): ?} */
      isEmpty : isEmpty,
      /** @type {function (?, ?): ?} */
      getXHR : send,
      /** @type {function (string): undefined} */
      injectStyle : error,
      /** @type {function (): ?} */
      hasFocus : Text
    };
  };
  $.FroalaEditor.COMMANDS = {
    bold : {
      title : "Bold"
    },
    italic : {
      title : "Italic"
    },
    underline : {
      title : "Underline"
    },
    strikeThrough : {
      title : "Strikethrough"
    },
    subscript : {
      title : "Subscript"
    },
    superscript : {
      title : "Superscript"
    },
    outdent : {
      title : "Decrease Indent"
    },
    indent : {
      title : "Increase Indent"
    },
    undo : {
      title : "Undo",
      undo : false,
      forcedRefresh : true,
      disabled : true
    },
    redo : {
      title : "Redo",
      undo : false,
      forcedRefresh : true,
      disabled : true
    },
    insertHR : {
      title : "Insert Horizontal Line"
    },
    clearFormatting : {
      title : "Clear Formatting"
    },
    selectAll : {
      title : "Select All",
      undo : false
    }
  };
  /**
   * @param {string} action
   * @param {?} opt_attributes
   * @return {undefined}
   */
  $.FroalaEditor.RegisterCommand = function(action, opt_attributes) {
    $.FroalaEditor.COMMANDS[action] = opt_attributes;
  };
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.commands = function(self) {
    /**
     * @param {string} index
     * @param {Array} callback
     * @return {undefined}
     */
    function update(index, callback) {
      if (self.events.trigger("commands.before", $.merge([index], callback || [])) !== false) {
        var fn = $.FroalaEditor.COMMANDS[index] && $.FroalaEditor.COMMANDS[index].callback || commands[index];
        /** @type {boolean} */
        var hover = true;
        if ($.FroalaEditor.COMMANDS[index]) {
          if ("undefined" != typeof $.FroalaEditor.COMMANDS[index].focus) {
            hover = $.FroalaEditor.COMMANDS[index].focus;
          }
        }
        if (!self.core.hasFocus()) {
          if (!!hover) {
            if (!self.popups.areVisible()) {
              self.events.focus(true);
            }
          }
        }
        if ($.FroalaEditor.COMMANDS[index]) {
          if ($.FroalaEditor.COMMANDS[index].undo !== false) {
            self.undo.saveStep();
          }
        }
        if (fn) {
          fn.apply(self, $.merge([index], callback || []));
        }
        self.events.trigger("commands.after", $.merge([index], callback || []));
        if ($.FroalaEditor.COMMANDS[index]) {
          if ($.FroalaEditor.COMMANDS[index].undo !== false) {
            self.undo.saveStep();
          }
        }
      }
    }
    /**
     * @param {string} command
     * @param {string} name
     * @return {undefined}
     */
    function highlight(command, name) {
      if (self.selection.isCollapsed() && self.document.queryCommandState(command) === false) {
        self.markers.insert();
        var $inline = self.$el.find(".fr-marker");
        $inline.replaceWith("<" + name + ">" + $.FroalaEditor.INVISIBLE_SPACE + $.FroalaEditor.MARKERS + "</" + name + ">");
        self.selection.restore();
      } else {
        var node = self.selection.element();
        if (self.selection.isCollapsed() && (self.document.queryCommandState(command) === true && (node.tagName == name.toUpperCase() && 0 === (node.textContent || "").replace(/\u200B/g, "").length))) {
          $(node).replaceWith($.FroalaEditor.MARKERS);
          self.selection.restore();
        } else {
          var ret = self.$el.find("span");
          /** @type {boolean} */
          var h = false;
          if (self.document.queryCommandState(command) === false) {
            self.selection.save();
            /** @type {boolean} */
            h = true;
          }
          self.document.execCommand(command, false, false);
          if (h) {
            self.selection.restore();
          }
          var others = self.$el.find("span[style]").not(ret).filter(function() {
            return $(this).attr("style").indexOf("font-weight: normal") >= 0;
          });
          if (others.length) {
            self.selection.save();
            others.each(function() {
              $(this).replaceWith($(this).html());
            });
            self.selection.restore();
          }
          self.clean.toHTML5();
        }
      }
    }
    /**
     * @param {number} delta
     * @return {undefined}
     */
    function init(delta) {
      self.selection.save();
      self.html.wrap(true, true);
      self.selection.restore();
      var j = self.selection.blocks();
      /** @type {number} */
      var i = 0;
      for (;i < j.length;i++) {
        if ("LI" != j[i].tagName && "LI" != j[i].parentNode.tagName) {
          var $this = $(j[i]);
          /** @type {string} */
          var type = "rtl" == self.opts.direction || "rtl" == $this.css("direction") ? "margin-right" : "margin-left";
          var from = self.helpers.getPX($this.css(type));
          $this.css(type, Math.max(from + 20 * delta, 0) || "");
          $this.removeClass("fr-temp-div");
        }
      }
      self.selection.save();
      self.html.unwrap();
      self.selection.restore();
    }
    /**
     * @return {undefined}
     */
    function render() {
      /**
       * @param {HTMLElement} target
       * @return {?}
       */
      var run = function(target) {
        return target.attr("style").indexOf("font-size") >= 0;
      };
      self.$el.find("[style]").each(function() {
        var $this = $(this);
        if (run($this)) {
          $this.attr("data-font-size", $this.css("font-size"));
          $this.css("font-size", "");
        }
      });
    }
    /**
     * @return {undefined}
     */
    function Plugin() {
      self.$el.find("[data-font-size]").each(function() {
        var $element = $(this);
        $element.css("font-size", $element.attr("data-font-size"));
        $element.removeAttr("data-font-size");
      });
    }
    /**
     * @return {undefined}
     */
    function load() {
      self.$el.find("span").each(function() {
        if ("" === self.node.attributes(this)) {
          $(this).replaceWith($(this).html());
        }
      });
    }
    /**
     * @param {string} value
     * @param {string} execResult
     * @return {undefined}
     */
    function parse(value, execResult) {
      if (self.selection.isCollapsed()) {
        self.markers.insert();
        var $inline = self.$el.find(".fr-marker");
        $inline.replaceWith('<span style="' + value + ": " + execResult + ';">' + $.FroalaEditor.INVISIBLE_SPACE + $.FroalaEditor.MARKERS + "</span>");
        self.selection.restore();
      } else {
        render();
        self.document.execCommand("fontSize", false, 4);
        self.selection.save();
        Plugin();
        var i;
        /**
         * @param {?} elem
         * @return {undefined}
         */
        var create = function(elem) {
          var $elem = $(elem);
          $elem.css(value, "");
          if ("" === $elem.attr("style")) {
            $elem.replaceWith($elem.html());
          }
        };
        /**
         * @return {?}
         */
        var next = function() {
          return 0 === $(this).attr("style").indexOf(value + ":") || ($(this).attr("style").indexOf(";" + value + ":") >= 0 || $(this).attr("style").indexOf("; " + value + ":") >= 0);
        };
        for (;self.$el.find("font").length > 0;) {
          var opts = self.$el.find("font:first");
          var el = $('<span class="fr-just" style="' + value + ": " + execResult + ';">' + opts.html() + "</span>");
          opts.replaceWith(el);
          var elems = el.find("span");
          /** @type {number} */
          i = elems.length - 1;
          for (;i >= 0;i--) {
            create(elems[i]);
          }
          var $this = el.parentsUntil(self.$el, "span").filter(next);
          if ($this.length) {
            /** @type {string} */
            var name = "";
            /** @type {string} */
            var x = "";
            /** @type {string} */
            var optsData = "";
            /** @type {string} */
            var y = "";
            var selectedNode = el.get(0);
            do {
              selectedNode = selectedNode.parentNode;
              name += self.node.closeTagString(selectedNode);
              x = self.node.openTagString(selectedNode) + x;
              if ($this.get(0) != selectedNode) {
                optsData += self.node.closeTagString(selectedNode);
                y = self.node.openTagString(selectedNode) + y;
              }
            } while ($this.get(0) != selectedNode);
            /** @type {string} */
            var repstr = name + '<span class="fr-just" style="' + value + ": " + execResult + ';">' + y + el.html() + optsData + "</span>" + x;
            el.replaceWith('<span id="fr-break"></span>');
            var html = $this.get(0).outerHTML;
            $this.replaceWith(html.replace(/<span id="fr-break"><\/span>/g, repstr));
          }
        }
        self.html.cleanEmptyTags();
        load();
        var codeSegments = self.$el.find(".fr-just + .fr-just");
        /** @type {number} */
        i = 0;
        for (;i < codeSegments.length;i++) {
          var target = $(codeSegments[i]);
          target.prepend(target.prev().html());
          target.prev().remove();
        }
        self.$el.find(".fr-marker + .fr-just").each(function() {
          $(this).prepend($(this).prev());
        });
        self.$el.find(".fr-just + .fr-marker").each(function() {
          $(this).append($(this).next());
        });
        self.$el.find(".fr-just").removeAttr("class");
        self.selection.restore();
      }
    }
    /**
     * @param {string} i
     * @return {?}
     */
    function callback(i) {
      return function() {
        update(i);
      };
    }
    var commands = {
      /**
       * @return {undefined}
       */
      bold : function() {
        highlight("bold", "strong");
      },
      /**
       * @return {undefined}
       */
      subscript : function() {
        highlight("subscript", "sub");
      },
      /**
       * @return {undefined}
       */
      superscript : function() {
        highlight("superscript", "sup");
      },
      /**
       * @return {undefined}
       */
      italic : function() {
        highlight("italic", "em");
      },
      /**
       * @return {undefined}
       */
      strikeThrough : function() {
        highlight("strikeThrough", "s");
      },
      /**
       * @return {undefined}
       */
      underline : function() {
        highlight("underline", "u");
      },
      /**
       * @return {undefined}
       */
      undo : function() {
        self.undo.run();
      },
      /**
       * @return {undefined}
       */
      redo : function() {
        self.undo.redo();
      },
      /**
       * @return {undefined}
       */
      indent : function() {
        init(1);
      },
      /**
       * @return {undefined}
       */
      outdent : function() {
        init(-1);
      },
      /**
       * @return {undefined}
       */
      show : function() {
        if (self.opts.toolbarInline) {
          self.toolbar.showInline(null, true);
        }
      },
      /**
       * @return {undefined}
       */
      insertHR : function() {
        self.selection.remove();
        self.html.insert('<hr id="fr-just">');
        var newNode = self.$el.find("hr#fr-just");
        newNode.removeAttr("id");
        if (!self.selection.setAfter(newNode.get(0))) {
          self.selection.setBefore(newNode.get(0));
        }
        self.selection.restore();
      },
      /**
       * @return {undefined}
       */
      clearFormatting : function() {
        if (self.browser.msie || self.browser.edge) {
          /**
           * @param {string} property
           * @return {undefined}
           */
          var init = function(property) {
            self.commands.applyProperty(property, "#123456");
            self.selection.save();
            self.$el.find("span:not(.fr-marker)").each(function(dataAndEvents, _element) {
              var element = $(_element);
              var scripts = element.css(property);
              if ("#123456" === scripts || "#123456" === self.helpers.RGBToHex(scripts)) {
                element.replaceWith(element.html());
              }
            });
            self.selection.restore();
          };
          init("color");
          init("background-color");
        }
        self.document.execCommand("removeFormat", false, false);
        self.document.execCommand("unlink", false, false);
      },
      /**
       * @return {undefined}
       */
      selectAll : function() {
        self.document.execCommand("selectAll", false, false);
      }
    };
    var output = {};
    var i;
    for (i in commands) {
      output[i] = callback(i);
    }
    return $.extend(output, {
      /** @type {function (string, Array): undefined} */
      exec : update,
      /** @type {function (string, string): undefined} */
      applyProperty : parse
    });
  };
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.cursorLists = function(self) {
    /**
     * @param {boolean} node
     * @return {?}
     */
    function fn(node) {
      /** @type {boolean} */
      var current = node;
      for (;"LI" != current.tagName;) {
        current = current.parentNode;
      }
      return current;
    }
    /**
     * @param {?} dataAndEvents
     * @return {?}
     */
    function clone(dataAndEvents) {
      var element = dataAndEvents;
      for (;!self.node.isList(element);) {
        element = element.parentNode;
      }
      return element;
    }
    /**
     * @param {Object} item
     * @return {undefined}
     */
    function update(item) {
      var current;
      var node = fn(item);
      var nn = node.nextSibling;
      var sib = node.previousSibling;
      var isVertical = self.html.defaultTag();
      if (self.node.isEmpty(node, true) && nn) {
        /** @type {string} */
        var x = "";
        /** @type {string} */
        var optsData = "";
        var element = item.parentNode;
        for (;!self.node.isList(element) && (element.parentNode && "LI" !== element.parentNode.tagName);) {
          x = self.node.openTagString(element) + x;
          optsData += self.node.closeTagString(element);
          element = element.parentNode;
        }
        x = self.node.openTagString(element) + x;
        optsData += self.node.closeTagString(element);
        /** @type {string} */
        var options = "";
        /** @type {string} */
        options = element.parentNode && "LI" == element.parentNode.tagName ? optsData + "<li>" + $.FroalaEditor.MARKERS + "<br>" + x : isVertical ? optsData + "<" + isVertical + ">" + $.FroalaEditor.MARKERS + "<br></" + isVertical + ">" + x : optsData + $.FroalaEditor.MARKERS + "<br>" + x;
        $(node).html('<span id="fr-break"></span>');
        for (;["UL", "OL"].indexOf(element.tagName) < 0 || element.parentNode && "LI" === element.parentNode.tagName;) {
          element = element.parentNode;
        }
        var model = self.node.openTagString(element) + $(element).html() + self.node.closeTagString(element);
        model = model.replace(/<span id="fr-break"><\/span>/g, options);
        $(element).replaceWith(model);
        self.$el.find("li:empty").remove();
      } else {
        if (sib && nn || !self.node.isEmpty(node, true)) {
          $(node).before("<li><br></li>");
          $(item).remove();
        } else {
          if (sib) {
            current = clone(node);
            if (current.parentNode && "LI" == current.parentNode.tagName) {
              $(current.parentNode).after("<li>" + $.FroalaEditor.MARKERS + "<br></li>");
            } else {
              if (isVertical) {
                $(current).after("<" + isVertical + ">" + $.FroalaEditor.MARKERS + "<br></" + isVertical + ">");
              } else {
                $(current).after($.FroalaEditor.MARKERS + "<br>");
              }
            }
            $(node).remove();
          } else {
            current = clone(node);
            if (current.parentNode && "LI" == current.parentNode.tagName) {
              $(current.parentNode).before("<li>" + $.FroalaEditor.MARKERS + "<br></li>");
            } else {
              if (isVertical) {
                $(current).before("<" + isVertical + ">" + $.FroalaEditor.MARKERS + "<br></" + isVertical + ">");
              } else {
                $(current).before($.FroalaEditor.MARKERS + "<br>");
              }
            }
            $(node).remove();
          }
        }
      }
    }
    /**
     * @param {Object} element
     * @return {undefined}
     */
    function handleClick(element) {
      var child = fn(element);
      /** @type {string} */
      var value = "";
      /** @type {Object} */
      var node = element;
      /** @type {string} */
      var expires = "";
      /** @type {string} */
      var name = "";
      for (;node != child;) {
        node = node.parentNode;
        /** @type {string} */
        var n = "A" == node.tagName && self.cursor.isAtEnd(element, node) ? "fr-to-remove" : "";
        expires = self.node.openTagString($(node).clone().addClass(n).get(0)) + expires;
        name = self.node.closeTagString(node) + name;
      }
      /** @type {string} */
      value = name + value + expires + $.FroalaEditor.MARKERS;
      $(element).replaceWith('<span id="fr-break"></span>');
      var template = self.node.openTagString(child) + $(child).html() + self.node.closeTagString(child);
      template = template.replace(/<span id="fr-break"><\/span>/g, value);
      $(child).replaceWith(template);
    }
    /**
     * @param {boolean} el
     * @return {undefined}
     */
    function init(el) {
      var parent = fn(el);
      var grape = $.FroalaEditor.MARKERS;
      /** @type {boolean} */
      var node = el;
      for (;node != parent;) {
        node = node.parentNode;
        /** @type {string} */
        var n = "A" == node.tagName && self.cursor.isAtEnd(el, node) ? "fr-to-remove" : "";
        grape = self.node.openTagString($(node).clone().addClass(n).get(0)) + grape + self.node.closeTagString(node);
      }
      $(el).remove();
      $(parent).after(grape);
    }
    /**
     * @param {boolean} el
     * @return {undefined}
     */
    function load(el) {
      var node = fn(el);
      var container = node.previousSibling;
      if (container) {
        container = $(container).find(self.html.blockTagsQuery()).get(-1) || container;
        $(el).replaceWith($.FroalaEditor.MARKERS);
        var elements = self.node.contents(container);
        if (elements.length) {
          if ("BR" == elements[elements.length - 1].tagName) {
            $(elements[elements.length - 1]).remove();
          }
        }
        $(node).find(self.html.blockTagsQuery()).not("ol, ul, table").each(function() {
          if (this.parentNode == node) {
            $(this).replaceWith($(this).html() + (self.node.isEmpty(this) ? "" : "<br>"));
          }
        });
        var first;
        var fragment = self.node.contents(node)[0];
        for (;fragment && !self.node.isList(fragment);) {
          first = fragment.nextSibling;
          $(container).append(fragment);
          fragment = first;
        }
        container = node.previousSibling;
        for (;fragment;) {
          first = fragment.nextSibling;
          $(container).append(fragment);
          fragment = first;
        }
        $(node).remove();
      } else {
        var element = clone(node);
        if ($(el).replaceWith($.FroalaEditor.MARKERS), element.parentNode && "LI" == element.parentNode.tagName) {
          var sibling = element.previousSibling;
          if (self.node.isBlock(sibling)) {
            $(node).find(self.html.blockTagsQuery()).not("ol, ul, table").each(function() {
              if (this.parentNode == node) {
                $(this).replaceWith($(this).html() + (self.node.isEmpty(this) ? "" : "<br>"));
              }
            });
            $(sibling).append($(node).html());
          } else {
            $(element).before($(node).html());
          }
        } else {
          var m = self.html.defaultTag();
          if (m && 0 === $(node).find(self.html.blockTagsQuery()).length) {
            $(element).before("<" + m + ">" + $(node).html() + "</" + m + ">");
          } else {
            $(element).before($(node).html());
          }
        }
        $(node).remove();
        if (0 === $(element).find("li").length) {
          $(element).remove();
        }
      }
    }
    /**
     * @param {boolean} element
     * @return {?}
     */
    function create(element) {
      var children;
      var el = fn(element);
      var tag = el.nextSibling;
      if (tag) {
        children = self.node.contents(tag);
        if (children.length) {
          if ("BR" == children[0].tagName) {
            $(children[0]).remove();
          }
        }
        $(tag).find(self.html.blockTagsQuery()).not("ol, ul, table").each(function() {
          if (this.parentNode == tag) {
            $(this).replaceWith($(this).html() + (self.node.isEmpty(this) ? "" : "<br>"));
          }
        });
        var first;
        /** @type {boolean} */
        var template = element;
        var fragment = self.node.contents(tag)[0];
        for (;fragment && !self.node.isList(fragment);) {
          first = fragment.nextSibling;
          $(template).after(fragment);
          template = fragment;
          fragment = first;
        }
        for (;fragment;) {
          first = fragment.nextSibling;
          $(el).append(fragment);
          fragment = first;
        }
        $(element).replaceWith($.FroalaEditor.MARKERS);
        $(tag).remove();
      } else {
        var node = el;
        for (;!node.nextSibling && node != self.$el.get(0);) {
          node = node.parentNode;
        }
        if (node == self.$el.get(0)) {
          return false;
        }
        if (node = node.nextSibling, self.node.isBlock(node)) {
          if ($.FroalaEditor.NO_DELETE_TAGS.indexOf(node.tagName) < 0) {
            $(element).replaceWith($.FroalaEditor.MARKERS);
            children = self.node.contents(el);
            if (children.length) {
              if ("BR" == children[children.length - 1].tagName) {
                $(children[children.length - 1]).remove();
              }
            }
            $(el).append($(node).html());
            $(node).remove();
          }
        } else {
          children = self.node.contents(el);
          if (children.length) {
            if ("BR" == children[children.length - 1].tagName) {
              $(children[children.length - 1]).remove();
            }
          }
          $(element).replaceWith($.FroalaEditor.MARKERS);
          for (;node && (!self.node.isBlock(node) && "BR" != node.tagName);) {
            $(el).append($(node));
            node = node.nextSibling;
          }
        }
      }
    }
    return{
      /** @type {function (Object): undefined} */
      _startEnter : update,
      /** @type {function (Object): undefined} */
      _middleEnter : handleClick,
      /** @type {function (boolean): undefined} */
      _endEnter : init,
      /** @type {function (boolean): undefined} */
      _backspace : load,
      /** @type {function (boolean): ?} */
      _del : create
    };
  };
  /** @type {Array} */
  $.FroalaEditor.NO_DELETE_TAGS = ["TH", "TD", "TABLE"];
  /** @type {Array} */
  $.FroalaEditor.SIMPLE_ENTER_TAGS = ["TH", "TD", "LI", "DL", "DT"];
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.cursor = function(self) {
    /**
     * @param {?} node
     * @return {?}
     */
    function check(node) {
      return self.node.isBlock(node) ? true : node.nextSibling ? false : check(node.parentNode);
    }
    /**
     * @param {?} target
     * @return {?}
     */
    function merge(target) {
      return self.node.isBlock(target) ? true : target.previousSibling ? false : merge(target.parentNode);
    }
    /**
     * @param {Element} target
     * @param {?} element
     * @return {?}
     */
    function find(target, element) {
      return target ? target == self.$wp.get(0) ? false : target.previousSibling ? false : target.parentNode == element ? true : find(target.parentNode, element) : false;
    }
    /**
     * @param {Object} e
     * @param {?} node
     * @return {?}
     */
    function fn(e, node) {
      return e ? e == self.$wp.get(0) ? false : e.nextSibling ? false : e.parentNode == node ? true : fn(e.parentNode, node) : false;
    }
    /**
     * @param {?} target
     * @return {?}
     */
    function each(target) {
      return $(target).parentsUntil(self.$el, "LI").length > 0 && 0 === $(target).parentsUntil("LI", "TABLE").length;
    }
    /**
     * @param {Element} selector
     * @return {undefined}
     */
    function create(selector) {
      /** @type {boolean} */
      var deepestParent = $(selector).parentsUntil(self.$el, "BLOCKQUOTE").length > 0;
      var element = self.node.deepestParent(selector, [], !deepestParent);
      if (element && "BLOCKQUOTE" == element.tagName) {
        var elem = self.node.deepestParent(selector, [$(selector).parentsUntil(self.$el, "BLOCKQUOTE").get(0)]);
        if (elem) {
          if (elem.previousSibling) {
            element = elem;
          }
        }
      }
      if (null !== element) {
        var elements;
        var node = element.previousSibling;
        if (self.node.isBlock(element) && (self.node.isEditable(element) && (node && ($.FroalaEditor.NO_DELETE_TAGS.indexOf(node.tagName) < 0 && self.node.isEditable(node))))) {
          if (self.node.isBlock(node)) {
            if (self.node.isEmpty(node) && !self.node.isList(node)) {
              $(node).remove();
            } else {
              if (self.node.isList(node) && (node = $(node).find("li:last").get(0)), elements = self.node.contents(node), elements.length && ("BR" == elements[elements.length - 1].tagName && $(elements[elements.length - 1]).remove()), "BLOCKQUOTE" == node.tagName && "BLOCKQUOTE" != element.tagName) {
                elements = self.node.contents(node);
                for (;elements.length && self.node.isBlock(elements[elements.length - 1]);) {
                  node = elements[elements.length - 1];
                  elements = self.node.contents(node);
                }
              } else {
                if ("BLOCKQUOTE" != node.tagName && "BLOCKQUOTE" == element.tagName) {
                  elements = self.node.contents(element);
                  for (;elements.length && self.node.isBlock(elements[0]);) {
                    element = elements[0];
                    elements = self.node.contents(element);
                  }
                }
              }
              $(selector).replaceWith($.FroalaEditor.MARKERS);
              $(node).append(element.innerHTML);
              $(element).remove();
            }
          } else {
            $(selector).replaceWith($.FroalaEditor.MARKERS);
            if ("BLOCKQUOTE" == element.tagName && node.nodeType == Node.ELEMENT_NODE) {
              $(node).remove();
            } else {
              $(node).after(self.node.isEmpty(element) ? "" : $(element).html());
              $(element).remove();
              if ("BR" == node.tagName) {
                $(node).remove();
              }
            }
          }
        }
      }
    }
    /**
     * @param {?} element
     * @return {?}
     */
    function parse(element) {
      var node = element;
      for (;!node.previousSibling;) {
        node = node.parentNode;
      }
      node = node.previousSibling;
      var nodes;
      if (self.node.isBlock(node)) {
        if ($.FroalaEditor.NO_DELETE_TAGS.indexOf(node.tagName) < 0) {
          if (self.node.isEmpty(node) && !self.node.isList(node)) {
            $(node).remove();
            $(element).replaceWith($.FroalaEditor.MARKERS);
          } else {
            if (self.node.isList(node)) {
              node = $(node).find("li:last").get(0);
            }
            nodes = self.node.contents(node);
            if (nodes) {
              if ("BR" == nodes[nodes.length - 1].tagName) {
                $(nodes[nodes.length - 1]).remove();
              }
            }
            nodes = self.node.contents(node);
            for (;nodes && self.node.isBlock(nodes[nodes.length - 1]);) {
              node = nodes[nodes.length - 1];
              nodes = self.node.contents(node);
            }
            $(node).append($.FroalaEditor.MARKERS);
            var child = element;
            for (;!child.previousSibling;) {
              child = child.parentNode;
            }
            for (;child && ("BR" !== child.tagName && !self.node.isBlock(child));) {
              var lineSeparator = child;
              child = child.nextSibling;
              $(node).append(lineSeparator);
            }
            if (child) {
              if ("BR" == child.tagName) {
                $(child).remove();
              }
            }
            $(element).remove();
          }
        }
      } else {
        nodes = self.node.contents(node);
        for (;node.nodeType != Node.TEXT_NODE && (nodes.length && !$(node).is("[contenteditable='false']"));) {
          node = nodes[nodes.length - 1];
          nodes = self.node.contents(node);
        }
        if (node.nodeType == Node.TEXT_NODE) {
          if (self.helpers.isIOS()) {
            return true;
          }
          $(node).after($.FroalaEditor.MARKERS);
          var template = node.textContent;
          /** @type {number} */
          var replace = template.length - 1;
          if (self.opts.tabSpaces && template.length >= self.opts.tabSpaces) {
            var lastLine = template.substr(template.length - self.opts.tabSpaces, template.length - 1);
            if (0 == lastLine.replace(/ /g, "").replace(new RegExp($.FroalaEditor.UNICODE_NBSP, "g"), "").length) {
              /** @type {number} */
              replace = template.length - self.opts.tabSpaces;
            }
          }
          node.textContent = template.substring(0, replace);
          if (node.textContent.length) {
            if (55357 == node.textContent.charCodeAt(node.textContent.length - 1)) {
              node.textContent = node.textContent.substr(0, node.textContent.length - 1);
            }
          }
        } else {
          if (self.events.trigger("node.remove", [$(node)]) !== false) {
            $(node).after($.FroalaEditor.MARKERS);
            $(node).remove();
          }
        }
      }
    }
    /**
     * @return {?}
     */
    function get() {
      /** @type {boolean} */
      var output = false;
      var input = self.markers.insert();
      if (!input) {
        return true;
      }
      self.$el.get(0).normalize();
      var node = input.previousSibling;
      if (node) {
        var value = node.textContent;
        if (value) {
          if (value.length) {
            if (8203 == value.charCodeAt(value.length - 1)) {
              if (1 == value.length) {
                $(node).remove();
              } else {
                node.textContent = node.textContent.substr(0, value.length - 1);
                if (node.textContent.length) {
                  if (55357 == node.textContent.charCodeAt(node.textContent.length - 1)) {
                    node.textContent = node.textContent.substr(0, node.textContent.length - 1);
                  }
                }
              }
            }
          }
        }
      }
      return check(input) ? output = parse(input) : merge(input) ? each(input) && find(input, $(input).parents("li:first").get(0)) ? self.cursorLists._backspace(input) : create(input) : output = parse(input), $(input).remove(), self.$el.find("blockquote:empty").remove(), self.html.fillEmptyBlocks(true), self.html.cleanEmptyTags(true), self.clean.quotes(), self.clean.lists(), self.html.normalizeSpaces(), self.selection.restore(), output;
    }
    /**
     * @param {string} element
     * @return {undefined}
     */
    function update(element) {
      /** @type {boolean} */
      var deepestParent = $(element).parentsUntil(self.$el, "BLOCKQUOTE").length > 0;
      var el = self.node.deepestParent(element, [], !deepestParent);
      if (el && "BLOCKQUOTE" == el.tagName) {
        var child = self.node.deepestParent(element, [$(element).parentsUntil(self.$el, "BLOCKQUOTE").get(0)]);
        if (child) {
          if (child.nextSibling) {
            el = child;
          }
        }
      }
      if (null !== el) {
        var nodes;
        var node = el.nextSibling;
        if (self.node.isBlock(el) && (self.node.isEditable(el) && (node && $.FroalaEditor.NO_DELETE_TAGS.indexOf(node.tagName) < 0))) {
          if (self.node.isBlock(node) && self.node.isEditable(node)) {
            if (self.node.isList(node)) {
              if (self.node.isEmpty(el, true)) {
                $(el).remove();
                $(node).find("li:first").prepend($.FroalaEditor.MARKERS);
              } else {
                var rule = $(node).find("li:first");
                if ("BLOCKQUOTE" == el.tagName) {
                  nodes = self.node.contents(el);
                  if (nodes.length) {
                    if (self.node.isBlock(nodes[nodes.length - 1])) {
                      el = nodes[nodes.length - 1];
                    }
                  }
                }
                if (0 === rule.find("ul, ol").length) {
                  $(element).replaceWith($.FroalaEditor.MARKERS);
                  rule.find(self.html.blockTagsQuery()).not("ol, ul, table").each(function() {
                    if (this.parentNode == rule.get(0)) {
                      $(this).replaceWith($(this).html() + (self.node.isEmpty(this) ? "" : "<br>"));
                    }
                  });
                  $(el).append(self.node.contents(rule.get(0)));
                  rule.remove();
                  if (0 === $(node).find("li").length) {
                    $(node).remove();
                  }
                }
              }
            } else {
              if (nodes = self.node.contents(node), nodes.length && ("BR" == nodes[0].tagName && $(nodes[0]).remove()), "BLOCKQUOTE" != node.tagName && "BLOCKQUOTE" == el.tagName) {
                nodes = self.node.contents(el);
                for (;nodes.length && self.node.isBlock(nodes[nodes.length - 1]);) {
                  el = nodes[nodes.length - 1];
                  nodes = self.node.contents(el);
                }
              } else {
                if ("BLOCKQUOTE" == node.tagName && "BLOCKQUOTE" != el.tagName) {
                  nodes = self.node.contents(node);
                  for (;nodes.length && self.node.isBlock(nodes[0]);) {
                    node = nodes[0];
                    nodes = self.node.contents(node);
                  }
                }
              }
              $(element).replaceWith($.FroalaEditor.MARKERS);
              $(el).append(node.innerHTML);
              $(node).remove();
            }
          } else {
            $(element).replaceWith($.FroalaEditor.MARKERS);
            for (;node && ("BR" !== node.tagName && (!self.node.isBlock(node) && self.node.isEditable(node)));) {
              var current = node;
              node = node.nextSibling;
              $(el).append(current);
            }
            if (node) {
              if ("BR" == node.tagName) {
                if (self.node.isEditable(node)) {
                  $(node).remove();
                }
              }
            }
          }
        }
      }
    }
    /**
     * @param {Object} element
     * @return {undefined}
     */
    function process(element) {
      /** @type {Object} */
      var node = element;
      for (;!node.nextSibling;) {
        node = node.parentNode;
      }
      if (node = node.nextSibling, "BR" == node.tagName && self.node.isEditable(node)) {
        if (node.nextSibling) {
          if (self.node.isBlock(node.nextSibling) && self.node.isEditable(node.nextSibling)) {
            if (!($.FroalaEditor.NO_DELETE_TAGS.indexOf(node.nextSibling.tagName) < 0)) {
              return;
            }
            node = node.nextSibling;
            $(node.previousSibling).remove();
          }
        } else {
          if (check(node)) {
            if (each(element)) {
              self.cursorLists._del(element);
            } else {
              var normalizedRange = self.node.deepestParent(node);
              if (normalizedRange) {
                $(node).remove();
                update(element);
              }
            }
            return;
          }
        }
      }
      var nodes;
      if (!self.node.isBlock(node) && self.node.isEditable(node)) {
        nodes = self.node.contents(node);
        for (;node.nodeType != Node.TEXT_NODE && (nodes.length && self.node.isEditable(node));) {
          node = nodes[0];
          nodes = self.node.contents(node);
        }
        if (node.nodeType == Node.TEXT_NODE) {
          $(node).before($.FroalaEditor.MARKERS);
          if (node.textContent.length && 55357 == node.textContent.charCodeAt(0)) {
            node.textContent = node.textContent.substring(2, node.textContent.length);
          } else {
            node.textContent = node.textContent.substring(1, node.textContent.length);
          }
        } else {
          if (self.events.trigger("node.remove", [$(node)]) !== false) {
            $(node).before($.FroalaEditor.MARKERS);
            $(node).remove();
          }
        }
        $(element).remove();
      } else {
        if ($.FroalaEditor.NO_DELETE_TAGS.indexOf(node.tagName) < 0) {
          if (self.node.isList(node)) {
            if (element.previousSibling) {
              $(node).find("li:first").prepend(element);
              self.cursorLists._backspace(element);
            } else {
              $(node).find("li:first").prepend($.FroalaEditor.MARKERS);
              $(element).remove();
            }
          } else {
            if (nodes = self.node.contents(node), nodes && ("BR" == nodes[0].tagName && $(nodes[0]).remove()), nodes && "BLOCKQUOTE" == node.tagName) {
              var el = nodes[0];
              $(element).before($.FroalaEditor.MARKERS);
              for (;el && "BR" != el.tagName;) {
                var d = el;
                el = el.nextSibling;
                $(element).before(d);
              }
              if (el) {
                if ("BR" == el.tagName) {
                  $(el).remove();
                }
              }
            } else {
              $(element).after($(node).html()).after($.FroalaEditor.MARKERS);
              $(node).remove();
            }
          }
        }
      }
    }
    /**
     * @return {?}
     */
    function start() {
      var input = self.markers.insert();
      if (!input) {
        return false;
      }
      if (self.$el.get(0).normalize(), check(input)) {
        if (each(input)) {
          if (0 === $(input).parents("li:first").find("ul, ol").length) {
            self.cursorLists._del(input);
          } else {
            var container = $(input).parents("li:first").find("ul:first, ol:first").find("li:first");
            container = container.find(self.html.blockTagsQuery()).get(-1) || container;
            container.prepend(input);
            self.cursorLists._backspace(input);
          }
        } else {
          update(input);
        }
      } else {
        process(merge(input) ? input : input);
      }
      $(input).remove();
      self.$el.find("blockquote:empty").remove();
      self.html.fillEmptyBlocks(true);
      self.html.cleanEmptyTags(true);
      self.clean.quotes();
      self.clean.lists();
      self.html.normalizeSpaces();
      self.selection.restore();
    }
    /**
     * @return {undefined}
     */
    function load() {
      self.$el.find(".fr-to-remove").each(function() {
        var codeSegments = self.node.contents(this);
        /** @type {number} */
        var i = 0;
        for (;i < codeSegments.length;i++) {
          if (codeSegments[i].nodeType == Node.TEXT_NODE) {
            codeSegments[i].textContent = codeSegments[i].textContent.replace(/\u200B/g, "");
          }
        }
        $(this).replaceWith(this.innerHTML);
      });
    }
    /**
     * @param {boolean} el
     * @param {boolean} value
     * @param {boolean} deepDataAndEvents
     * @return {?}
     */
    function callback(el, value, deepDataAndEvents) {
      var letter;
      var node = self.node.deepestParent(el, [], !deepDataAndEvents);
      if (node && "BLOCKQUOTE" == node.tagName) {
        return fn(el, node) ? (letter = self.html.defaultTag(), letter ? $(node).after("<" + letter + ">" + $.FroalaEditor.MARKERS + "<br></" + letter + ">") : $(node).after($.FroalaEditor.MARKERS + "<br>"), $(el).remove(), false) : (remove(el, value, deepDataAndEvents), false);
      }
      if (null == node) {
        $(el).replaceWith("<br/>" + $.FroalaEditor.MARKERS + "<br/>");
      } else {
        /** @type {boolean} */
        var parent = el;
        /** @type {string} */
        var options = "";
        if (!self.node.isBlock(node) || value) {
          /** @type {string} */
          options = "<br/>";
        }
        /** @type {string} */
        var classes = "";
        /** @type {string} */
        var count = "";
        letter = self.html.defaultTag();
        /** @type {string} */
        var position = "";
        /** @type {string} */
        var optsData = "";
        if (letter) {
          if (self.node.isBlock(node)) {
            /** @type {string} */
            position = "<" + letter + ">";
            /** @type {string} */
            optsData = "</" + letter + ">";
            if (node.tagName == letter.toUpperCase()) {
              position = self.node.openTagString($(node).clone().removeAttr("id").get(0));
            }
          }
        }
        do {
          if (parent = parent.parentNode, !value || (parent != node || value && !self.node.isBlock(node))) {
            if (classes += self.node.closeTagString(parent), parent == node && self.node.isBlock(node)) {
              count = position + count;
            } else {
              /** @type {string} */
              var n = "A" == parent.tagName && fn(el, parent) ? "fr-to-remove" : "";
              count = self.node.openTagString($(parent).clone().addClass(n).get(0)) + count;
            }
          }
        } while (parent != node);
        /** @type {string} */
        options = classes + options + count + (el.parentNode == node && self.node.isBlock(node) ? "" : $.FroalaEditor.INVISIBLE_SPACE) + $.FroalaEditor.MARKERS;
        if (self.node.isBlock(node)) {
          if (!$(node).find("*:last").is("br")) {
            $(node).append("<br/>");
          }
        }
        $(el).after('<span id="fr-break"></span>');
        $(el).remove();
        if (!(node.nextSibling && !self.node.isBlock(node.nextSibling))) {
          if (!self.node.isBlock(node)) {
            $(node).after("<br>");
          }
        }
        var model;
        model = !value && self.node.isBlock(node) ? self.node.openTagString(node) + $(node).html() + optsData : self.node.openTagString(node) + $(node).html() + self.node.closeTagString(node);
        model = model.replace(/<span id="fr-break"><\/span>/g, options);
        $(node).replaceWith(model);
      }
    }
    /**
     * @param {Element} el
     * @param {boolean} value
     * @param {boolean} deepDataAndEvents
     * @return {?}
     */
    function handler(el, value, deepDataAndEvents) {
      var selector = self.node.deepestParent(el, [], !deepDataAndEvents);
      if (selector && "BLOCKQUOTE" == selector.tagName) {
        if (find(el, selector)) {
          var i = self.html.defaultTag();
          return i ? $(selector).before("<" + i + ">" + $.FroalaEditor.MARKERS + "<br></" + i + ">") : $(selector).before($.FroalaEditor.MARKERS + "<br>"), $(el).remove(), false;
        }
        if (fn(el, selector)) {
          callback(el, value, true);
        } else {
          remove(el, value, true);
        }
      }
      if (null == selector) {
        $(el).replaceWith("<br>" + $.FroalaEditor.MARKERS);
      } else {
        if (self.node.isBlock(selector)) {
          if (value) {
            $(el).remove();
            $(selector).prepend("<br>" + $.FroalaEditor.MARKERS);
          } else {
            if (self.node.isEmpty(selector, true)) {
              return callback(el, value, deepDataAndEvents);
            }
            $(selector).before(self.node.openTagString($(selector).clone().removeAttr("id").get(0)) + "<br>" + self.node.closeTagString(selector));
          }
        } else {
          $(selector).before("<br>");
        }
        $(el).remove();
      }
    }
    /**
     * @param {Element} el
     * @param {boolean} xs
     * @param {boolean} deepDataAndEvents
     * @return {undefined}
     */
    function remove(el, xs, deepDataAndEvents) {
      var node = self.node.deepestParent(el, [], !deepDataAndEvents);
      if (null == node) {
        if (!el.nextSibling || self.node.isBlock(el.nextSibling)) {
          $(el).after("<br>");
        }
        $(el).replaceWith("<br>" + $.FroalaEditor.MARKERS);
      } else {
        /** @type {Element} */
        var parent = el;
        /** @type {string} */
        var t = "";
        if ("PRE" == node.tagName) {
          /** @type {boolean} */
          xs = true;
        }
        if (!self.node.isBlock(node) || xs) {
          /** @type {string} */
          t = "<br>";
        }
        /** @type {string} */
        var prefix = "";
        /** @type {string} */
        var name = "";
        do {
          var container = parent;
          if (parent = parent.parentNode, "BLOCKQUOTE" == node.tagName && (self.node.isEmpty(container) && (!$(container).hasClass("fr-marker") && ($(container).find(el).length > 0 && $(container).after(el)))), ("BLOCKQUOTE" != node.tagName || !fn(el, parent) && !find(el, parent)) && (!xs || (parent != node || xs && !self.node.isBlock(node)))) {
            prefix += self.node.closeTagString(parent);
            /** @type {string} */
            var focusClass = "A" == parent.tagName && fn(el, parent) ? "fr-to-remove" : "";
            name = self.node.openTagString($(parent).clone().addClass(focusClass).removeAttr("id").get(0)) + name;
          }
        } while (parent != node);
        var drop = node == el.parentNode && self.node.isBlock(node) || el.nextSibling;
        if ("BLOCKQUOTE" == node.tagName) {
          if (el.previousSibling) {
            if (self.node.isBlock(el.previousSibling)) {
              if (el.nextSibling) {
                if ("BR" == el.nextSibling.tagName) {
                  $(el.nextSibling).after(el);
                  if (el.nextSibling) {
                    if ("BR" == el.nextSibling.tagName) {
                      $(el.nextSibling).remove();
                    }
                  }
                }
              }
            }
          }
          var enabled = self.html.defaultTag();
          /** @type {string} */
          t = prefix + t + (enabled ? "<" + enabled + ">" : "") + $.FroalaEditor.MARKERS + "<br>" + (enabled ? "</" + enabled + ">" : "") + name;
        } else {
          /** @type {string} */
          t = prefix + t + name + (drop ? "" : $.FroalaEditor.INVISIBLE_SPACE) + $.FroalaEditor.MARKERS;
        }
        $(el).replaceWith('<span id="fr-break"></span>');
        var str = self.node.openTagString(node) + $(node).html() + self.node.closeTagString(node);
        str = str.replace(/<span id="fr-break"><\/span>/g, t);
        $(node).replaceWith(str);
      }
    }
    /**
     * @param {boolean} value
     * @return {?}
     */
    function insert(value) {
      var el = self.markers.insert();
      if (!el) {
        return true;
      }
      self.$el.get(0).normalize();
      /** @type {boolean} */
      var deepDataAndEvents = false;
      if ($(el).parentsUntil(self.$el, "BLOCKQUOTE").length > 0) {
        /** @type {boolean} */
        value = false;
        /** @type {boolean} */
        deepDataAndEvents = true;
      }
      if ($(el).parentsUntil(self.$el, "TD, TH").length) {
        /** @type {boolean} */
        deepDataAndEvents = false;
      }
      if (check(el)) {
        if (!each(el) || (value || deepDataAndEvents)) {
          callback(el, value, deepDataAndEvents);
        } else {
          self.cursorLists._endEnter(el);
        }
      } else {
        if (merge(el)) {
          if (!each(el) || (value || deepDataAndEvents)) {
            handler(el, value, deepDataAndEvents);
          } else {
            self.cursorLists._startEnter(el);
          }
        } else {
          if (!each(el) || (value || deepDataAndEvents)) {
            remove(el, value, deepDataAndEvents);
          } else {
            self.cursorLists._middleEnter(el);
          }
        }
      }
      load();
      self.html.fillEmptyBlocks(true);
      self.html.cleanEmptyTags(true);
      self.clean.lists();
      self.html.normalizeSpaces();
      self.selection.restore();
    }
    return{
      /** @type {function (boolean): ?} */
      enter : insert,
      /** @type {function (): ?} */
      backspace : get,
      /** @type {function (): ?} */
      del : start,
      /** @type {function (Object, ?): ?} */
      isAtEnd : fn
    };
  };
  /**
   * @param {string} data
   * @return {?}
   */
  $.FroalaEditor.MODULES.data = function(data) {
    /**
     * @param {string} s
     * @return {?}
     */
    function trim(s) {
      return s;
    }
    /**
     * @param {(Array|number)} value
     * @return {?}
     */
    function getValue(value) {
      if (!value) {
        return value;
      }
      /** @type {string} */
      var html = "";
      var key = trim("charCodeAt");
      var name = trim("fromCharCode");
      /** @type {number} */
      var h = seen.indexOf(value[0]);
      /** @type {number} */
      var i = 1;
      for (;i < value.length - 2;i++) {
        var camelKey = format(++h);
        var data = value[key](i);
        /** @type {string} */
        var cDigit = "";
        for (;/[0-9-]/.test(value[i + 1]);) {
          cDigit += value[++i];
        }
        /** @type {number} */
        cDigit = parseInt(cDigit, 10) || 0;
        data = convert(data, camelKey, cDigit);
        data ^= h - 1 & 31;
        html += String[name](data);
      }
      return html;
    }
    /**
     * @param {(number|string)} formatString
     * @return {?}
     */
    function format(formatString) {
      var haystack = formatString.toString();
      /** @type {number} */
      var offsetTop = 0;
      /** @type {number} */
      var i = 0;
      for (;i < haystack.length;i++) {
        offsetTop += parseInt(haystack.charAt(i), 10);
      }
      return offsetTop > 10 ? offsetTop % 9 + 1 : offsetTop;
    }
    /**
     * @param {number} d
     * @param {number} value
     * @param {number} num
     * @return {?}
     */
    function convert(d, value, num) {
      /** @type {number} */
      var valid = Math.abs(num);
      for (;valid-- > 0;) {
        d -= value;
      }
      return 0 > num && (d += 123), d;
    }
    /**
     * @param {Object} element
     * @return {?}
     */
    function refresh(element) {
      return element && "none" == element.css("display") ? (element.remove(), true) : false;
    }
    /**
     * @return {?}
     */
    function bind() {
      return refresh(scroller) || refresh(activeClassName);
    }
    /**
     * @return {?}
     */
    function render() {
      return data.$box ? (data.$box.append(value(trim(value("kTDD4spmKD1klaMB1C7A5RA1G3RA10YA5qhrjuvnmE1D3FD2bcG-7noHE6B2JB4C3xXA8WF6F-10RG2C3G3B-21zZE3C3H3xCA16NC4DC1f1hOF1MB3B-21whzQH5UA2WB10kc1C2F4D3XC2YD4D1C4F3GF2eJ2lfcD-13HF1IE1TC11TC7WE4TA4d1A2YA6XA4d1A3yCG2qmB-13GF4A1B1KH1HD2fzfbeQC3TD9VE4wd1H2A20A2B-22ujB3nBG2A13jBC10D3C2HD5D1H1KB11uD-16uWF2D4A3F-7C9D-17c1E4D4B3d1D2CA6B2B-13qlwzJF2NC2C-13E-11ND1A3xqUA8UE6bsrrF-7C-22ia1D2CF2H1E2akCD2OE1HH1dlKA6PA5jcyfzB-22cXB4f1C3qvdiC4gjGG2H2gklC3D-16wJC1UG4dgaWE2D5G4g1I2H3B7vkqrxH1H2EC9C3E4gdgzKF1OA1A5PF5C4WWC3VA6XA4e1E3YA2YA5HE4oGH4F2H2IB10D3D2NC5G1B1qWA9PD6PG5fQA13A10XA4C4A3e1H2BA17kC-22cmOB1lmoA2fyhcptwWA3RA8A-13xB-11nf1I3f1B7GB3aD3pavFC10D5gLF2OG1LSB2D9E7fQC1F4F3wpSB5XD3NkklhhaE-11naKA9BnIA6D1F5bQA3A10c1QC6Kjkvitc2B6BE3AF3E2DA6A4JD2IC1jgA-64MB11D6C4==")))), 
      scroller = data.$box.find("> div:last"), activeClassName = scroller.find("> a"), void("rtl" == data.opts.direction && scroller.css("left", "auto").css("right", 0))) : false;
    }
    /**
     * @return {undefined}
     */
    function add() {
      var codeSegments = data.opts.key || [""];
      if ("string" == typeof codeSegments) {
        /** @type {Array} */
        codeSegments = [codeSegments];
      }
      /** @type {boolean} */
      data.ul = true;
      /** @type {number} */
      var i = 0;
      for (;i < codeSegments.length;i++) {
        var src = value(codeSegments[i]) || "";
        if (!(src !== value(trim(value("mcVRDoB1BGILD7YFe1BTXBA7B6=="))) && (src.indexOf(term, src.length - term.length) < 0 && [value("9qqG-7amjlwq=="), value("KA3B3C2A6D1D5H5H1A3==")].indexOf(term) < 0))) {
          /** @type {boolean} */
          data.ul = false;
          break;
        }
      }
      if (data.ul === true) {
        render();
      }
      data.events.on("contentChanged", function() {
        if (data.ul === true) {
          if (bind()) {
            render();
          }
        }
      });
    }
    var scroller;
    var activeClassName;
    /** @type {string} */
    var seen = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var term = function() {
      /** @type {number} */
      var a = 0;
      /** @type {string} */
      var url = document.domain;
      /** @type {Array.<string>} */
      var models = url.split(".");
      /** @type {string} */
      var uid = "_gd" + (new Date).getTime();
      for (;a < models.length - 1 && -1 == document.cookie.indexOf(uid + "=" + uid);) {
        /** @type {string} */
        url = models.slice(-1 - ++a).join(".");
        /** @type {string} */
        document.cookie = uid + "=" + uid + ";domain=" + url + ";";
      }
      return document.cookie = uid + "=;expires=Thu, 01 Jan 1970 00:00:01 GMT;domain=" + url + ";", url;
    }();
    var value = trim(getValue);
    return{
      /** @type {function (): undefined} */
      _init : add
    };
  };
  /** @type {number} */
  $.FroalaEditor.ENTER_P = 0;
  /** @type {number} */
  $.FroalaEditor.ENTER_DIV = 1;
  /** @type {number} */
  $.FroalaEditor.ENTER_BR = 2;
  $.FroalaEditor.KEYCODE = {
    BACKSPACE : 8,
    TAB : 9,
    ENTER : 13,
    SHIFT : 16,
    CTRL : 17,
    ALT : 18,
    ESC : 27,
    SPACE : 32,
    DELETE : 46,
    ZERO : 48,
    ONE : 49,
    TWO : 50,
    THREE : 51,
    FOUR : 52,
    FIVE : 53,
    SIX : 54,
    SEVEN : 55,
    EIGHT : 56,
    NINE : 57,
    FF_SEMICOLON : 59,
    FF_EQUALS : 61,
    QUESTION_MARK : 63,
    A : 65,
    B : 66,
    C : 67,
    D : 68,
    E : 69,
    F : 70,
    G : 71,
    H : 72,
    I : 73,
    J : 74,
    K : 75,
    L : 76,
    M : 77,
    N : 78,
    O : 79,
    P : 80,
    Q : 81,
    R : 82,
    S : 83,
    T : 84,
    U : 85,
    V : 86,
    W : 87,
    X : 88,
    Y : 89,
    Z : 90,
    META : 91,
    NUM_ZERO : 96,
    NUM_ONE : 97,
    NUM_TWO : 98,
    NUM_THREE : 99,
    NUM_FOUR : 100,
    NUM_FIVE : 101,
    NUM_SIX : 102,
    NUM_SEVEN : 103,
    NUM_EIGHT : 104,
    NUM_NINE : 105,
    NUM_MULTIPLY : 106,
    NUM_PLUS : 107,
    NUM_MINUS : 109,
    NUM_PERIOD : 110,
    NUM_DIVISION : 111,
    SEMICOLON : 186,
    DASH : 189,
    EQUALS : 187,
    COMMA : 188,
    PERIOD : 190,
    SLASH : 191,
    APOSTROPHE : 192,
    TILDE : 192,
    SINGLE_QUOTE : 222,
    OPEN_SQUARE_BRACKET : 219,
    BACKSLASH : 220,
    CLOSE_SQUARE_BRACKET : 221
  };
  $.extend($.FroalaEditor.DEFAULTS, {
    enter : $.FroalaEditor.ENTER_P,
    multiLine : true,
    tabSpaces : 0
  });
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.keys = function(self) {
    /**
     * @return {undefined}
     */
    function handler() {
      if (self.helpers.isIOS()) {
        var oldScrollTop = $(self.original_window).scrollTop();
        self.events.disableBlur();
        self.selection.save();
        self.$el.blur();
        self.selection.restore();
        self.events.enableBlur();
        $(self.original_window).scrollTop(oldScrollTop);
      }
    }
    /**
     * @param {Event} event
     * @return {undefined}
     */
    function render(event) {
      event.preventDefault();
      event.stopPropagation();
      if (self.opts.multiLine) {
        if (!self.selection.isCollapsed()) {
          self.selection.remove();
        }
        self.cursor.enter();
      }
      handler();
    }
    /**
     * @param {Event} event
     * @return {undefined}
     */
    function fn(event) {
      event.preventDefault();
      event.stopPropagation();
      if (self.opts.multiLine) {
        if (!self.selection.isCollapsed()) {
          self.selection.remove();
        }
        self.cursor.enter(true);
      }
    }
    /**
     * @param {Event} event
     * @return {undefined}
     */
    function callback(event) {
      if (self.selection.isCollapsed()) {
        if (!self.cursor.backspace()) {
          event.preventDefault();
          event.stopPropagation();
          /** @type {boolean} */
          x = false;
        }
      } else {
        event.preventDefault();
        event.stopPropagation();
        self.selection.remove();
        self.html.fillEmptyBlocks(true);
        /** @type {boolean} */
        x = false;
      }
      self.placeholder.refresh();
    }
    /**
     * @param {Event} e
     * @return {undefined}
     */
    function remove(e) {
      e.preventDefault();
      e.stopPropagation();
      if ("" === self.selection.text()) {
        self.cursor.del();
      } else {
        self.selection.remove();
      }
      self.placeholder.refresh();
    }
    /**
     * @param {Event} event
     * @return {undefined}
     */
    function onSuccess(event) {
      if (self.browser.mozilla) {
        event.preventDefault();
        event.stopPropagation();
        if (!self.selection.isCollapsed()) {
          self.selection.remove();
        }
        self.markers.insert();
        var node = self.$el.find(".fr-marker").get(0);
        var parent = node.previousSibling;
        var nn = node.nextSibling;
        if (!nn && (node.parentNode && "A" == node.parentNode.tagName)) {
          $(node).parent().after("&nbsp;" + $.FroalaEditor.MARKERS);
          $(node).remove();
        } else {
          if (parent && (parent.nodeType == Node.TEXT_NODE && (1 == parent.textContent.length && 160 == parent.textContent.charCodeAt(0)))) {
            $(parent).after(" ");
          } else {
            $(node).before("&nbsp;");
          }
          $(node).replaceWith($.FroalaEditor.MARKERS);
        }
        self.selection.restore();
      }
    }
    /**
     * @return {undefined}
     */
    function set() {
      if (self.browser.mozilla && (self.selection.isCollapsed() && !elem)) {
        var rng = self.selection.ranges(0);
        var node = rng.startContainer;
        var end = rng.startOffset;
        if (node) {
          if (node.nodeType == Node.TEXT_NODE) {
            if (end <= node.textContent.length) {
              if (end > 0) {
                if (32 == node.textContent.charCodeAt(end - 1)) {
                  self.selection.save();
                  self.html.normalizeSpaces();
                  self.selection.restore();
                }
              }
            }
          }
        }
      }
    }
    /**
     * @return {undefined}
     */
    function init() {
      if (self.selection.isFull()) {
        setTimeout(function() {
          var c = self.html.defaultTag();
          if (c) {
            self.$el.html("<" + c + ">" + $.FroalaEditor.MARKERS + "<br/></" + c + ">");
          } else {
            self.$el.html($.FroalaEditor.MARKERS + "<br/>");
          }
          self.selection.restore();
          self.placeholder.refresh();
          self.button.bulkRefresh();
          self.undo.saveStep();
        }, 0);
      }
    }
    /**
     * @param {Event} event
     * @return {undefined}
     */
    function start(event) {
      if (self.opts.tabSpaces > 0) {
        if (self.selection.isCollapsed()) {
          event.preventDefault();
          event.stopPropagation();
          /** @type {string} */
          var msgs = "";
          /** @type {number} */
          var tabSpaces = 0;
          for (;tabSpaces < self.opts.tabSpaces;tabSpaces++) {
            msgs += "&nbsp;";
          }
          self.html.insert(msgs);
          self.placeholder.refresh();
        } else {
          event.preventDefault();
          event.stopPropagation();
          if (event.shiftKey) {
            self.commands.outdent();
          } else {
            self.commands.indent();
          }
        }
      }
    }
    /**
     * @param {?} dataAndEvents
     * @return {undefined}
     */
    function clone(dataAndEvents) {
      /** @type {boolean} */
      elem = false;
    }
    /**
     * @return {?}
     */
    function restoreScript() {
      return elem;
    }
    /**
     * @param {Event} e
     * @return {?}
     */
    function add(e) {
      self.events.disableBlur();
      /** @type {boolean} */
      x = true;
      var keyCode = e.which;
      if (16 === keyCode) {
        return true;
      }
      if (229 === keyCode) {
        return elem = true, true;
      }
      /** @type {boolean} */
      elem = false;
      var program = keyDown(keyCode) && !onKeyDown(e);
      /** @type {boolean} */
      var inverse = keyCode == $.FroalaEditor.KEYCODE.BACKSPACE || keyCode == $.FroalaEditor.KEYCODE.DELETE;
      if (self.selection.isFull() && !self.opts.keepFormatOnDelete || inverse && (self.placeholder.isVisible() && self.opts.keepFormatOnDelete)) {
        if (program || inverse) {
          var m = self.html.defaultTag();
          if (m) {
            self.$el.html("<" + m + ">" + $.FroalaEditor.MARKERS + "<br/></" + m + ">");
          } else {
            self.$el.html($.FroalaEditor.MARKERS + "<br/>");
          }
        }
        self.selection.restore();
      }
      if (keyCode == $.FroalaEditor.KEYCODE.ENTER) {
        if (e.shiftKey) {
          fn(e);
        } else {
          render(e);
        }
      } else {
        if (keyCode != $.FroalaEditor.KEYCODE.BACKSPACE || onKeyDown(e)) {
          if (keyCode != $.FroalaEditor.KEYCODE.DELETE || onKeyDown(e)) {
            if (keyCode == $.FroalaEditor.KEYCODE.SPACE) {
              onSuccess(e);
            } else {
              if (keyCode == $.FroalaEditor.KEYCODE.TAB) {
                start(e);
              } else {
                if (!onKeyDown(e)) {
                  if (!!keyDown(e.which)) {
                    if (!self.selection.isCollapsed()) {
                      self.selection.remove();
                    }
                  }
                }
              }
            }
          } else {
            remove(e);
          }
        } else {
          callback(e);
        }
      }
      self.events.enableBlur();
    }
    /**
     * @param {Array} args
     * @return {undefined}
     */
    function parse(args) {
      /** @type {number} */
      var i = 0;
      for (;i < args.length;i++) {
        if (args[i].nodeType == Node.TEXT_NODE && /\u200B/gi.test(args[i].textContent)) {
          args[i].textContent = args[i].textContent.replace(/\u200B/gi, "");
          if (0 === args[i].textContent.length) {
            $(args[i]).remove();
          }
        } else {
          if (args[i].nodeType == Node.ELEMENT_NODE) {
            if ("IFRAME" != args[i].nodeType) {
              parse(self.node.contents(args[i]));
            }
          }
        }
      }
    }
    /**
     * @return {?}
     */
    function update() {
      if (!self.$wp) {
        return true;
      }
      var top;
      if (self.opts.height || self.opts.heightMax) {
        top = self.position.getBoundingRect().top;
        if (self.opts.iframe) {
          top += self.$iframe.offset().top;
        }
        if (top > self.$wp.offset().top - $(self.original_window).scrollTop() + self.$wp.height() - 20) {
          self.$wp.scrollTop(top + self.$wp.scrollTop() - (self.$wp.height() + self.$wp.offset().top) + $(self.original_window).scrollTop() + 20);
        }
      } else {
        top = self.position.getBoundingRect().top;
        if (self.opts.iframe) {
          top += self.$iframe.offset().top;
        }
        if (top > self.original_window.innerHeight - 20) {
          $(self.original_window).scrollTop(top + $(self.original_window).scrollTop() - self.original_window.innerHeight + 20);
        }
        top = self.position.getBoundingRect().top;
        if (self.opts.iframe) {
          top += self.$iframe.offset().top;
        }
        if (top < self.$tb.height() + 20) {
          $(self.original_window).scrollTop(top + $(self.original_window).scrollTop() - self.$tb.height() - 20);
        }
      }
    }
    /**
     * @param {Event} e
     * @return {?}
     */
    function initialize(e) {
      if (elem) {
        return false;
      }
      if (!self.selection.isCollapsed()) {
        return false;
      }
      if (!!e) {
        if (!(e.which != $.FroalaEditor.KEYCODE.ENTER && e.which != $.FroalaEditor.KEYCODE.BACKSPACE)) {
          if (!(e.which == $.FroalaEditor.KEYCODE.BACKSPACE && x)) {
            update();
          }
        }
      }
      var codeSegments = self.$el.find(self.html.blockTagsQuery()).andSelf().not("TD, TH").find(" > br");
      /** @type {number} */
      var i = 0;
      for (;i < codeSegments.length;i++) {
        var el = codeSegments[i];
        var container = el.previousSibling;
        var cur = el.nextSibling;
        var _cell = self.node.blockParent(el) || self.$el.get(0);
        if (container) {
          if (_cell) {
            if ("BR" != container.tagName) {
              if (!self.node.isBlock(container)) {
                if (!cur) {
                  if ($(_cell).text().replace(/\u200B/g, "").length > 0) {
                    if ($(container).text().length > 0) {
                      self.selection.save();
                      $(el).remove();
                      self.selection.restore();
                    }
                  }
                }
              }
            }
          }
        }
      }
      /**
       * @param {?} element
       * @return {?}
       */
      var get = function(element) {
        if (!element) {
          return false;
        }
        var requestUrl = $(element).html();
        return requestUrl = requestUrl.replace(/<span[^>]*? class\s*=\s*["']?fr-marker["']?[^>]+>\u200b<\/span>/gi, ""), requestUrl && (/\u200B/.test(requestUrl) && requestUrl.replace(/\u200B/gi, "").length > 0) ? true : false;
      };
      var node = self.selection.element();
      if (get(node)) {
        if (0 === $(node).find("li").length) {
          if (!$(node).hasClass("fr-marker")) {
            if ("IFRAME" != node.tagName) {
              self.selection.save();
              parse(self.node.contents(node));
              self.selection.restore();
            }
          }
        }
      }
      if (!self.browser.mozilla) {
        if (self.html.doNormalize()) {
          self.selection.save();
          self.html.normalizeSpaces();
          self.selection.restore();
        }
      }
    }
    /**
     * @param {Event} e
     * @return {?}
     */
    function onKeyDown(e) {
      if (-1 != navigator.userAgent.indexOf("Mac OS X")) {
        if (e.metaKey && !e.altKey) {
          return true;
        }
      } else {
        if (e.ctrlKey && !e.altKey) {
          return true;
        }
      }
      return false;
    }
    /**
     * @param {?} keyCode
     * @return {?}
     */
    function keyDown(keyCode) {
      if (keyCode >= $.FroalaEditor.KEYCODE.ZERO && keyCode <= $.FroalaEditor.KEYCODE.NINE) {
        return true;
      }
      if (keyCode >= $.FroalaEditor.KEYCODE.NUM_ZERO && keyCode <= $.FroalaEditor.KEYCODE.NUM_MULTIPLY) {
        return true;
      }
      if (keyCode >= $.FroalaEditor.KEYCODE.A && keyCode <= $.FroalaEditor.KEYCODE.Z) {
        return true;
      }
      if (self.browser.webkit && 0 === keyCode) {
        return true;
      }
      switch(keyCode) {
        case $.FroalaEditor.KEYCODE.SPACE:
        ;
        case $.FroalaEditor.KEYCODE.QUESTION_MARK:
        ;
        case $.FroalaEditor.KEYCODE.NUM_PLUS:
        ;
        case $.FroalaEditor.KEYCODE.NUM_MINUS:
        ;
        case $.FroalaEditor.KEYCODE.NUM_PERIOD:
        ;
        case $.FroalaEditor.KEYCODE.NUM_DIVISION:
        ;
        case $.FroalaEditor.KEYCODE.SEMICOLON:
        ;
        case $.FroalaEditor.KEYCODE.FF_SEMICOLON:
        ;
        case $.FroalaEditor.KEYCODE.DASH:
        ;
        case $.FroalaEditor.KEYCODE.EQUALS:
        ;
        case $.FroalaEditor.KEYCODE.FF_EQUALS:
        ;
        case $.FroalaEditor.KEYCODE.COMMA:
        ;
        case $.FroalaEditor.KEYCODE.PERIOD:
        ;
        case $.FroalaEditor.KEYCODE.SLASH:
        ;
        case $.FroalaEditor.KEYCODE.APOSTROPHE:
        ;
        case $.FroalaEditor.KEYCODE.SINGLE_QUOTE:
        ;
        case $.FroalaEditor.KEYCODE.OPEN_SQUARE_BRACKET:
        ;
        case $.FroalaEditor.KEYCODE.BACKSLASH:
        ;
        case $.FroalaEditor.KEYCODE.CLOSE_SQUARE_BRACKET:
          return true;
        default:
          return false;
      }
    }
    /**
     * @param {Event} e
     * @return {?}
     */
    function onResize(e) {
      var key = e.which;
      return onKeyDown(e) || key >= 37 && 40 >= key ? true : (tref || (originalEvent = self.snapshot.get()), clearTimeout(tref), void(tref = setTimeout(function() {
        /** @type {null} */
        tref = null;
        self.undo.saveStep();
      }, 500)));
    }
    /**
     * @param {Event} e
     * @return {?}
     */
    function draw(e) {
      return onKeyDown(e) ? true : void(originalEvent && (tref && (self.undo.saveStep(originalEvent), originalEvent = null)));
    }
    /**
     * @return {undefined}
     */
    function success() {
      if (tref) {
        clearTimeout(tref);
        self.undo.saveStep();
        /** @type {null} */
        originalEvent = null;
      }
    }
    /**
     * @return {undefined}
     */
    function Editor() {
      if (self.events.on("keydown", onResize), self.events.on("input", set), self.events.on("keyup", draw), self.events.on("keypress", clone), self.events.on("keydown", add), self.events.on("keyup", initialize), self.events.on("html.inserted", initialize), self.events.on("cut", init), self.$el.get(0).msGetInputContext) {
        try {
          self.$el.get(0).msGetInputContext().addEventListener("MSCandidateWindowShow", function() {
            /** @type {boolean} */
            elem = true;
          });
          self.$el.get(0).msGetInputContext().addEventListener("MSCandidateWindowHide", function() {
            /** @type {boolean} */
            elem = false;
            initialize();
          });
        } catch (a) {
        }
      }
    }
    var x;
    var tref;
    var originalEvent;
    /** @type {boolean} */
    var elem = false;
    return{
      /** @type {function (): undefined} */
      _init : Editor,
      /** @type {function (Event): ?} */
      ctrlKey : onKeyDown,
      /** @type {function (?): ?} */
      isCharacter : keyDown,
      /** @type {function (): undefined} */
      forceUndo : success,
      /** @type {function (): ?} */
      isIME : restoreScript
    };
  };
  $.extend($.FroalaEditor.DEFAULTS, {
    pastePlain : false,
    pasteDeniedTags : ["colgroup", "col"],
    pasteDeniedAttrs : ["class", "id", "style"],
    pasteAllowLocalImages : false
  });
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.paste = function(self) {
    /**
     * @param {Event} src
     * @return {undefined}
     */
    function init(src) {
      value = self.html.getSelected();
      string = $("<div>").html(value).text();
      if ("cut" == src.type) {
        self.undo.saveStep();
        setTimeout(function() {
          self.html.wrap();
          self.events.focus();
          self.undo.saveStep();
        }, 0);
      }
    }
    /**
     * @param {Object} e
     * @return {?}
     */
    function f(e) {
      if (q) {
        return false;
      }
      if (e.originalEvent && (e = e.originalEvent), self.events.trigger("paste.before", [e]) === false) {
        return false;
      }
      if (n = self.$window.scrollTop(), e && (e.clipboardData && e.clipboardData.getData)) {
        /** @type {string} */
        var requestUrl = "";
        var copy = e.clipboardData.types;
        if (self.helpers.isArray(copy)) {
          /** @type {number} */
          var i = 0;
          for (;i < copy.length;i++) {
            requestUrl += copy[i] + ";";
          }
        } else {
          requestUrl = copy;
        }
        if (text = "", /text\/html/.test(requestUrl) ? text = e.clipboardData.getData("text/html") : /text\/rtf/.test(requestUrl) && self.browser.safari ? text = e.clipboardData.getData("text/rtf") : /text\/plain/.test(requestUrl) && (!this.browser.mozilla && (text = self.html.escapeEntities(e.clipboardData.getData("text/plain")).replace(/\n/g, "<br>"))), "" !== text) {
          return start(), e.preventDefault && (e.stopPropagation(), e.preventDefault()), false;
        }
        /** @type {null} */
        text = null;
      }
      select();
    }
    /**
     * @return {undefined}
     */
    function select() {
      self.selection.save();
      self.events.disableBlur();
      /** @type {null} */
      text = null;
      if (textarea) {
        textarea.html("");
      } else {
        textarea = $('<div contenteditable="true" style="position: fixed; top: 0; left: -9999px; height: 100%; width: 0; z-index: 9999; line-height: 140%;" tabindex="-1"></div>');
        self.$box.after(textarea);
      }
      textarea.focus();
      self.window.setTimeout(start, 1);
    }
    /**
     * @param {Object} v
     * @return {?}
     */
    function create(v) {
      v = v.replace(/<p(.*?)class="?'?MsoListParagraph"?'? ([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<ul><li>$3</li></ul>");
      v = v.replace(/<p(.*?)class="?'?NumberedText"?'? ([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<ol><li>$3</li></ol>");
      v = v.replace(/<p(.*?)class="?'?MsoListParagraphCxSpFirst"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<ul><li$3>$5</li>");
      v = v.replace(/<p(.*?)class="?'?NumberedTextCxSpFirst"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<ol><li$3>$5</li>");
      v = v.replace(/<p(.*?)class="?'?MsoListParagraphCxSpMiddle"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<li$3>$5</li>");
      v = v.replace(/<p(.*?)class="?'?NumberedTextCxSpMiddle"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<li$3>$5</li>");
      v = v.replace(/<p(.*?)class="?'?MsoListParagraphCxSpLast"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<li$3>$5</li></ul>");
      v = v.replace(/<p(.*?)class="?'?NumberedTextCxSpLast"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<li$3>$5</li></ol>");
      v = v.replace(/<span([^<]*?)style="?'?mso-list:Ignore"?'?([\s\S]*?)>([\s\S]*?)<span/gi, "<span><span");
      v = v.replace(/\x3c!--\[if \!supportLists\]--\x3e([\s\S]*?)\x3c!--\[endif\]--\x3e/gi, "");
      v = v.replace(/<!\[if \!supportLists\]>([\s\S]*?)<!\[endif\]>/gi, "");
      v = v.replace(/(\n|\r| class=(")?Mso[a-zA-Z0-9]+(")?)/gi, " ");
      v = v.replace(/\x3c!--[\s\S]*?--\x3e/gi, "");
      v = v.replace(/<(\/)*(meta|link|span|\\?xml:|st1:|o:|font)(.*?)>/gi, "");
      /** @type {Array} */
      var badTags = ["style", "script", "applet", "embed", "noframes", "noscript"];
      /** @type {number} */
      var i = 0;
      for (;i < badTags.length;i++) {
        /** @type {RegExp} */
        var regexp = new RegExp("<" + badTags[i] + ".*?" + badTags[i] + "(.*?)>", "gi");
        v = v.replace(regexp, "");
      }
      v = v.replace(/&nbsp;/gi, " ");
      v = v.replace(/<td([^>]*)><\/td>/g, "<td$1><br></td>");
      v = v.replace(/<th([^>]*)><\/th>/g, "<th$1><br></th>");
      var current;
      do {
        /** @type {Object} */
        current = v;
        v = v.replace(/<[^\/>][^>]*><\/[^>]+>/gi, "");
      } while (v != current);
      v = v.replace(/<lilevel([^1])([^>]*)>/gi, '<li data-indent="true"$2>');
      v = v.replace(/<lilevel1([^>]*)>/gi, "<li$1>");
      v = self.clean.html(v, self.opts.pasteDeniedTags, self.opts.pasteDeniedAttrs);
      v = v.replace(/<a>(.[^<]+)<\/a>/gi, "$1");
      var el = $("<div>").html(v);
      return el.find("li[data-indent]").each(function(dataAndEvents, li) {
        var ul = $(li);
        if (ul.prev("li").length > 0) {
          var $ul = ul.prev("li").find("> ul, > ol");
          if (0 === $ul.length) {
            $ul = $("ul");
            ul.prev("li").append($ul);
          }
          $ul.append(li);
        } else {
          ul.removeAttr("data-indent");
        }
      }), v = el.html();
    }
    /**
     * @param {string} m
     * @return {?}
     */
    function load(m) {
      var box = $("<div>").html(m);
      box.find("p, div, h1, h2, h3, h4, h5, h6, pre, blockquote").each(function(dataAndEvents, element) {
        $(element).replaceWith("<" + (self.html.defaultTag() || "DIV") + ">" + $(element).html() + "</" + (self.html.defaultTag() || "DIV") + ">");
      });
      $(box.find("*").not("p, div, h1, h2, h3, h4, h5, h6, pre, blockquote, ul, ol, li, table, tbody, thead, tr, td, br").get().reverse()).each(function() {
        $(this).replaceWith($(this).html());
      });
      /**
       * @param {Node} node
       * @return {undefined}
       */
      var load = function(node) {
        var codeSegments = self.node.contents(node);
        /** @type {number} */
        var i = 0;
        for (;i < codeSegments.length;i++) {
          if (3 != codeSegments[i].nodeType && 1 != codeSegments[i].nodeType) {
            $(codeSegments[i]).remove();
          } else {
            load(codeSegments[i]);
          }
        }
      };
      return load(box.get(0)), box.html();
    }
    /**
     * @return {undefined}
     */
    function start() {
      self.keys.forceUndo();
      var originalEvent = self.snapshot.get();
      if (null === text) {
        text = textarea.html();
        self.selection.restore();
        self.events.enableBlur();
      }
      var t = self.events.chainTrigger("paste.beforeCleanup", text);
      if ("string" == typeof t && (text = t), text.indexOf("<body") >= 0 && (text = text.replace(/[.\s\S\w\W<>]*<body[^>]*>([.\s\S\w\W<>]*)<\/body>[.\s\S\w\W<>]*/g, "$1")), text.indexOf('id="docs-internal-guid') >= 0 && (text = text.replace(/^.* id="docs-internal-guid[^>]*>(.*)<\/b>.*$/, "$1")), text.match(/(class=\"?Mso|style=\"[^\"]*\bmso\-|w:WordDocument)/gi) ? (text = text.replace(/^\n*/g, "").replace(/^ /g, ""), 0 === text.indexOf("<colgroup>") && (text = "<table>" + text + "</table>"), text = 
      create(text), text = parse(text)) : (self.opts.htmlAllowComments = false, text = self.clean.html(text, self.opts.pasteDeniedTags, self.opts.pasteDeniedAttrs), self.opts.htmlAllowComments = true, text = parse(text), text = text.replace(/\r|\n|\t/g, ""), string && ($("<div>").html(text).text().replace(/(\u00A0)/gi, " ").replace(/\r|\n/gi, "") == string.replace(/(\u00A0)/gi, " ").replace(/\r|\n/gi, "") && (text = value)), text = text.replace(/^ */g, "").replace(/ *$/g, "")), self.opts.pastePlain && 
      (text = load(text)), t = self.events.chainTrigger("paste.afterCleanup", text), "string" == typeof t && (text = t), "" !== text) {
        var fixture = $("<div>").html(text);
        self.html.cleanBlankSpaces(fixture.get(0));
        self.html.normalizeSpaces(fixture.get(0));
        fixture.find("span").each(function() {
          if (0 == this.attributes.length) {
            $(this).replaceWith(this.innerHTML);
          }
        });
        text = fixture.html();
        self.html.insert(text, true);
      }
      cleanUp();
      self.undo.saveStep(originalEvent);
      self.undo.saveStep();
    }
    /**
     * @return {undefined}
     */
    function cleanUp() {
      self.events.trigger("paste.after");
    }
    /**
     * @param {string} tag
     * @return {?}
     */
    function parse(tag) {
      var i;
      var elements = $("<div>").html(tag);
      var codeSegments = elements.find("*:empty:not(br, img, td, th)");
      for (;codeSegments.length;) {
        /** @type {number} */
        i = 0;
        for (;i < codeSegments.length;i++) {
          $(codeSegments[i]).remove();
        }
        codeSegments = elements.find("*:empty:not(br, img, td, th)");
      }
      var resultItems = elements.find("> div:not([style]), td > div, th > div, li > div");
      for (;resultItems.length;) {
        var $this = $(resultItems[resultItems.length - 1]);
        $this.replaceWith($this.html() + "<br>");
        resultItems = elements.find("> div:not([style]), td > div, th > div, li > div");
      }
      resultItems = elements.find("div:not([style])");
      for (;resultItems.length;) {
        /** @type {number} */
        i = 0;
        for (;i < resultItems.length;i++) {
          var target = $(resultItems[i]);
          var elem = target.html().replace(/\u0009/gi, "").trim();
          target.replaceWith(elem);
        }
        resultItems = elements.find("div:not([style])");
      }
      return elements.html();
    }
    /**
     * @return {undefined}
     */
    function handler() {
      self.events.on("copy", init);
      self.events.on("cut", init);
      self.events.on("paste", f);
      self.$el.on("contextmenu", function(e) {
        if (2 == e.button) {
          setTimeout(function() {
            /** @type {boolean} */
            q = false;
          }, 50);
          /** @type {boolean} */
          q = true;
        }
      });
      self.events.on("beforepaste", f);
    }
    var value;
    var string;
    var n;
    var text;
    var textarea;
    /** @type {boolean} */
    var q = false;
    return{
      /** @type {function (): undefined} */
      _init : handler
    };
  };
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.tooltip = function(self) {
    /**
     * @return {undefined}
     */
    function hide() {
      self.$tooltip.removeClass("fr-visible").css("left", "-3000px");
    }
    /**
     * @param {Object} el
     * @param {boolean} callback
     * @return {?}
     */
    function show(el, callback) {
      if (el.data("title") || el.data("title", el.attr("title")), !el.data("title")) {
        return false;
      }
      el.removeAttr("title");
      self.$tooltip.text(el.data("title"));
      self.$tooltip.addClass("fr-visible");
      var meterPos = el.offset().left + (el.outerWidth() - self.$tooltip.outerWidth()) / 2;
      if (0 > meterPos) {
        /** @type {number} */
        meterPos = 0;
      }
      if (meterPos + self.$tooltip.outerWidth() > $(self.original_window).width()) {
        /** @type {number} */
        meterPos = $(self.original_window).width() - self.$tooltip.outerWidth();
      }
      self.$tooltip.css("left", meterPos);
      if ("undefined" == typeof callback) {
        callback = self.opts.toolbarBottom;
      }
      self.$tooltip.css("top", callback ? el.offset().top - self.$tooltip.height() : el.offset().top + el.outerHeight());
    }
    /**
     * @param {Object} element
     * @param {?} handle
     * @param {boolean} type
     * @return {undefined}
     */
    function init(element, handle, type) {
      if (!self.helpers.isMobile()) {
        element.on("mouseenter", handle, function(ev) {
          if (!$(ev.currentTarget).hasClass("fr-disabled")) {
            show($(ev.currentTarget), type);
          }
        });
        element.on("mouseleave " + self._mousedown + " " + self._mouseup, handle, function(dataAndEvents) {
          hide();
        });
      }
      self.events.on("destroy", function() {
        element.off("mouseleave " + self._mousedown + " " + self._mouseup, handle);
        element.off("mouseenter", handle);
      }, true);
    }
    /**
     * @return {undefined}
     */
    function render() {
      if (!self.helpers.isMobile()) {
        self.$tooltip = $('<div class="fr-tooltip"></div>');
        if (self.opts.theme) {
          self.$tooltip.addClass(self.opts.theme + "-theme");
        }
        $(self.original_document).find("body").append(self.$tooltip);
        self.events.on("destroy", function() {
          self.$tooltip.html("").removeData().remove();
        }, true);
      }
    }
    return{
      /** @type {function (): undefined} */
      _init : render,
      /** @type {function (): undefined} */
      hide : hide,
      /** @type {function (Object, boolean): ?} */
      to : show,
      /** @type {function (Object, ?, boolean): undefined} */
      bind : init
    };
  };
  /** @type {string} */
  $.FroalaEditor.ICON_DEFAULT_TEMPLATE = "font_awesome";
  $.FroalaEditor.ICON_TEMPLATES = {
    font_awesome : '<i class="fa fa-[NAME]"></i>',
    text : '<span style="text-align: center;">[NAME]</span>',
    image : "<img src=[SRC] alt=[ALT] />"
  };
  $.FroalaEditor.ICONS = {
    bold : {
      NAME : "bold"
    },
    italic : {
      NAME : "italic"
    },
    underline : {
      NAME : "underline"
    },
    strikeThrough : {
      NAME : "strikethrough"
    },
    subscript : {
      NAME : "subscript"
    },
    superscript : {
      NAME : "superscript"
    },
    color : {
      NAME : "tint"
    },
    outdent : {
      NAME : "outdent"
    },
    indent : {
      NAME : "indent"
    },
    undo : {
      NAME : "rotate-left"
    },
    redo : {
      NAME : "rotate-right"
    },
    insertHR : {
      NAME : "minus"
    },
    clearFormatting : {
      NAME : "eraser"
    },
    selectAll : {
      NAME : "mouse-pointer"
    }
  };
  /**
   * @param {?} i
   * @param {?} offsetPosition
   * @return {undefined}
   */
  $.FroalaEditor.DefineIconTemplate = function(i, offsetPosition) {
    $.FroalaEditor.ICON_TEMPLATES[i] = offsetPosition;
  };
  /**
   * @param {?} i
   * @param {?} offsetPosition
   * @return {undefined}
   */
  $.FroalaEditor.DefineIcon = function(i, offsetPosition) {
    $.FroalaEditor.ICONS[i] = offsetPosition;
  };
  /**
   * @param {?} hspace
   * @return {?}
   */
  $.FroalaEditor.MODULES.icon = function(hspace) {
    /**
     * @param {Node} name
     * @return {?}
     */
    function create(name) {
      /** @type {null} */
      var altName = null;
      var map = $.FroalaEditor.ICONS[name];
      if ("undefined" != typeof map) {
        var template = map.template || $.FroalaEditor.ICON_DEFAULT_TEMPLATE;
        if (template) {
          if (template = $.FroalaEditor.ICON_TEMPLATES[template]) {
            altName = template.replace(/\[([a-zA-Z]*)\]/g, function(dataAndEvents, lcName) {
              return "NAME" == lcName ? map[lcName] || name : map[lcName];
            });
          }
        }
      }
      return altName || name;
    }
    return{
      /** @type {function (Node): ?} */
      create : create
    };
  };
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.button = function(self) {
    /**
     * @param {Event} element
     * @return {undefined}
     */
    function init(element) {
      var t = $(element.currentTarget);
      var child = t.next();
      var fr_active = t.hasClass("fr-active");
      var listEntries = (self.helpers.isMobile(), $(".fr-dropdown.fr-active").not(t));
      if (self.helpers.isIOS() && (0 == self.$el.find(".fr-marker").length && (self.selection.save(), self.selection.clear(), self.selection.restore())), !fr_active) {
        var request = t.data("cmd");
        child.find(".fr-command").removeClass("fr-active");
        if ($.FroalaEditor.COMMANDS[request]) {
          if ($.FroalaEditor.COMMANDS[request].refreshOnShow) {
            $.FroalaEditor.COMMANDS[request].refreshOnShow.apply(self, [t, child]);
          }
        }
        child.css("left", t.offset().left - t.parent().offset().left - ("rtl" == self.opts.direction ? child.width() - t.outerWidth() : 0));
        if (self.opts.toolbarBottom) {
          child.css("bottom", self.$tb.height() - t.position().top);
        } else {
          child.css("top", t.position().top + t.outerHeight());
        }
      }
      t.addClass("fr-blink").toggleClass("fr-active");
      setTimeout(function() {
        t.removeClass("fr-blink");
      }, 300);
      if (child.offset().left + child.outerWidth() > $(self.opts.scrollableContainer).offset().left + $(self.opts.scrollableContainer).outerWidth()) {
        child.css("margin-left", -(child.offset().left + child.outerWidth() - $(self.opts.scrollableContainer).offset().left - $(self.opts.scrollableContainer).outerWidth()));
      }
      listEntries.removeClass("fr-active");
    }
    /**
     * @param {Node} body
     * @return {undefined}
     */
    function next(body) {
      body.addClass("fr-blink");
      setTimeout(function() {
        body.removeClass("fr-blink");
      }, 500);
      var elem = body.data("cmd");
      /** @type {Array} */
      var cycle = [];
      for (;"undefined" != typeof body.data("param" + (cycle.length + 1));) {
        cycle.push(body.data("param" + (cycle.length + 1)));
      }
      var $slide = $(".fr-dropdown.fr-active");
      if ($slide.length) {
        $slide.removeClass("fr-active");
      }
      self.commands.exec(elem, cycle);
    }
    /**
     * @param {Event} event
     * @return {undefined}
     */
    function _trigger(event) {
      var elem = $(event.currentTarget);
      next(elem);
    }
    /**
     * @param {Event} element
     * @return {undefined}
     */
    function show(element) {
      var c = $(element.currentTarget);
      if (!(0 != c.parents(".fr-popup").length)) {
        if (!c.data("popup")) {
          self.popups.hideAll();
        }
      }
      if (c.hasClass("fr-dropdown")) {
        init(element);
      } else {
        _trigger(element);
        if ($.FroalaEditor.COMMANDS[c.data("cmd")]) {
          if (0 != $.FroalaEditor.COMMANDS[c.data("cmd")].refreshAfterCallback) {
            render();
          }
        }
      }
    }
    /**
     * @param {Object} element
     * @return {undefined}
     */
    function animate(element) {
      var listEntries = element.find(".fr-dropdown.fr-active");
      if (listEntries.length) {
        listEntries.removeClass("fr-active");
      }
    }
    /**
     * @param {?} event
     * @return {undefined}
     */
    function stop(event) {
      event.preventDefault();
      event.stopPropagation();
    }
    /**
     * @param {?} event
     * @return {?}
     */
    function clickHandler(event) {
      return event.stopPropagation(), self.opts.toolbarInline ? false : void 0;
    }
    /**
     * @param {Object} element
     * @param {boolean} event
     * @return {undefined}
     */
    function on(element, event) {
      self.events.bindClick(element, ".fr-command:not(.fr-disabled)", show);
      element.on(self._mousedown + " " + self._mouseup + " " + self._move, ".fr-dropdown-menu", stop);
      element.on(self._mousedown + " " + self._mouseup + " " + self._move, ".fr-dropdown-menu .fr-dropdown-wrapper", clickHandler);
      var doc = element.get(0).ownerDocument;
      var hashLink = "defaultView" in doc ? doc.defaultView : doc.parentWindow;
      /**
       * @param {Event} e
       * @return {undefined}
       */
      var init = function(e) {
        if (!e || (e.type == self._mouseup && e.target != $("html").get(0) || "keydown" == e.type && (self.keys.isCharacter(e.which) && !self.keys.ctrlKey(e) || e.which == $.FroalaEditor.KEYCODE.ESC))) {
          animate(element);
        }
      };
      $(hashLink).on(self._mouseup + ".command" + self.id + " resize.command" + self.id + " keydown.command" + self.id, init);
      $.merge(nodes, element.find(".fr-btn").toArray());
      self.tooltip.bind(element, ".fr-btn, .fr-title", event);
      self.events.on("destroy", function() {
        element.off(self._mousedown + " " + self._mouseup + " " + self._move, ".fr-dropdown-menu");
        element.on(self._mousedown + " " + self._mouseup + " " + self._move, ".fr-dropdown-menu .fr-dropdown-wrapper");
        $(hashLink).off(self._mouseup + ".command" + self.id + " resize.command" + self.id + " keydown.command" + self.id);
      }, true);
    }
    /**
     * @param {string} event
     * @param {Object} target
     * @return {?}
     */
    function select(event, target) {
      /** @type {string} */
      var results = "";
      if (target.html) {
        results += "function" == typeof target.html ? target.html.call(self) : target.html;
      } else {
        var item = target.options;
        if ("function" == typeof item) {
          item = item();
        }
        results += '<ul class="fr-dropdown-list">';
        var key;
        for (key in item) {
          results += '<li><a class="fr-command" data-cmd="' + event + '" data-param1="' + key + '" title="' + item[key] + '">' + self.language.translate(item[key]) + "</a></li>";
        }
        results += "</ul>";
      }
      return results;
    }
    /**
     * @param {string} key
     * @param {Object} opts
     * @param {boolean} value
     * @return {?}
     */
    function process(key, opts, value) {
      var fn = opts.displaySelection;
      if ("function" == typeof fn) {
        fn = fn(self);
      }
      var f;
      if (fn) {
        var g = "function" == typeof opts.defaultSelection ? opts.defaultSelection(self) : opts.defaultSelection;
        /** @type {string} */
        f = '<span style="width:' + (opts.displaySelectionWidth || 100) + 'px">' + (g || self.language.translate(opts.title)) + "</span>";
      } else {
        f = self.icon.create(opts.icon || key);
      }
      /** @type {string} */
      var failureMessage = opts.popup ? ' data-popup="true"' : "";
      /** @type {string} */
      var output = '<button type="button" tabindex="-1" title="' + (self.language.translate(opts.title) || "") + '" class="fr-command fr-btn' + ("dropdown" == opts.type ? " fr-dropdown" : "") + (opts.back ? " fr-back" : "") + (opts.disabled ? " fr-disabled" : "") + (value ? "" : " fr-hidden") + '" data-cmd="' + key + '"' + failureMessage + ">" + f + "</button>";
      if ("dropdown" == opts.type) {
        /** @type {string} */
        var result = '<div class="fr-dropdown-menu"><div class="fr-dropdown-wrapper"><div class="fr-dropdown-content" tabindex="-1">';
        result += select(key, opts);
        result += "</div></div></div>";
        output += result;
      }
      return output;
    }
    /**
     * @param {Array} args
     * @param {string} scope
     * @return {?}
     */
    function start(args, scope) {
      /** @type {string} */
      var tmp = "";
      /** @type {number} */
      var i = 0;
      for (;i < args.length;i++) {
        var last = args[i];
        var o = $.FroalaEditor.COMMANDS[last];
        if (!(o && ("undefined" != typeof o.plugin && self.opts.pluginsEnabled.indexOf(o.plugin) < 0))) {
          if (o) {
            /** @type {boolean} */
            var udataCur = "undefined" != typeof scope ? scope.indexOf(last) >= 0 : true;
            tmp += process(last, o, udataCur);
          } else {
            if ("|" == last) {
              tmp += '<div class="fr-separator fr-vs"></div>';
            } else {
              if ("-" == last) {
                tmp += '<div class="fr-separator fr-hs"></div>';
              }
            }
          }
        }
      }
      return tmp;
    }
    /**
     * @param {Node} e
     * @return {undefined}
     */
    function click(e) {
      var url;
      var i = e.data("cmd");
      if (e.hasClass("fr-dropdown")) {
        url = e.next();
      } else {
        e.removeClass("fr-active");
      }
      if ($.FroalaEditor.COMMANDS[i] && $.FroalaEditor.COMMANDS[i].refresh) {
        $.FroalaEditor.COMMANDS[i].refresh.apply(self, [e, url]);
      } else {
        if (self.refresh[i]) {
          self.refresh[i](e, url);
        } else {
          self.refresh["default"](e, i);
        }
      }
    }
    /**
     * @return {?}
     */
    function render() {
      return 0 == self.events.trigger("buttons.refresh") ? true : void setTimeout(function() {
        var c = self.selection.inEditor() && self.core.hasFocus();
        /** @type {number} */
        var i = 0;
        for (;i < nodes.length;i++) {
          var button = $(nodes[i]);
          var request = button.data("cmd");
          if (0 == button.parents(".fr-popup").length) {
            if (c || $.FroalaEditor.COMMANDS[request] && $.FroalaEditor.COMMANDS[request].forcedRefresh) {
              click(button);
            } else {
              if (!button.hasClass("fr-dropdown")) {
                button.removeClass("fr-active");
              }
            }
          } else {
            if (button.parents(".fr-popup").is(":visible")) {
              click(button);
            }
          }
        }
      }, 0);
    }
    /**
     * @return {undefined}
     */
    function unbind() {
      self.events.on("mouseup", render);
      self.events.on("keyup", render);
      self.events.on("blur", render);
      self.events.on("focus", render);
      self.events.on("contentChanged", render);
    }
    /** @type {Array} */
    var nodes = [];
    return{
      /** @type {function (): undefined} */
      _init : unbind,
      /** @type {function (Array, string): ?} */
      buildList : start,
      /** @type {function (Object, boolean): undefined} */
      bindCommands : on,
      /** @type {function (Node): undefined} */
      refresh : click,
      /** @type {function (): ?} */
      bulkRefresh : render,
      /** @type {function (Node): undefined} */
      exec : next
    };
  };
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.position = function(self) {
    /**
     * @return {?}
     */
    function position() {
      var me;
      var range = self.selection.ranges(0);
      if (range && (range.collapsed && self.selection.inEditor())) {
        /** @type {boolean} */
        var e = false;
        if (0 == self.$el.find(".fr-marker").length) {
          self.selection.save();
          /** @type {boolean} */
          e = true;
        }
        var item = self.$el.find(".fr-marker:first");
        item.css("display", "inline");
        item.css("line-height", "");
        var offset = item.offset();
        var r = item.outerHeight();
        item.css("display", "none");
        item.css("line-height", 0);
        me = {};
        me.left = offset.left;
        /** @type {number} */
        me.width = 0;
        me.height = r;
        /** @type {number} */
        me.top = offset.top - $(self.original_window).scrollTop();
        /** @type {number} */
        me.right = 1;
        /** @type {number} */
        me.bottom = 1;
        /** @type {boolean} */
        me.ok = true;
        if (e) {
          self.selection.restore();
        }
      } else {
        if (range) {
          me = range.getBoundingClientRect();
        }
      }
      return me;
    }
    /**
     * @param {Object} node
     * @param {number} d
     * @param {number} token
     * @return {?}
     */
    function handler(node, d, token) {
      var b = node.outerHeight();
      if (!self.helpers.isMobile() && (self.$tb && node.parent().get(0) != self.$tb.get(0))) {
        var a = (node.parent().height() - 20 - (self.opts.toolbarBottom ? self.$tb.outerHeight() : 0), node.parent().offset().top);
        /** @type {number} */
        var top = d - b - (token || 0);
        if (node.parent().get(0) == $(self.opts.scrollableContainer).get(0)) {
          a -= node.parent().position().top;
        }
        if (a + d + b > $(self.original_document).outerHeight() && node.parent().offset().top + top > 0) {
          /** @type {number} */
          d = top;
          node.addClass("fr-above");
        } else {
          node.removeClass("fr-above");
        }
      }
      return d;
    }
    /**
     * @param {Object} element
     * @param {?} left
     * @return {?}
     */
    function move(element, left) {
      var type = element.outerWidth();
      return element.parent().offset().left + left + type > $(self.opts.scrollableContainer).width() - 10 && (left = $(self.opts.scrollableContainer).width() - type - 10 - element.parent().offset().left + $(self.opts.scrollableContainer).offset().left), element.parent().offset().left + left < $(self.opts.scrollableContainer).offset().left && (left = 10 - element.parent().offset().left + $(self.opts.scrollableContainer).offset().left), left;
    }
    /**
     * @param {Object} body
     * @return {undefined}
     */
    function render(body) {
      var pos = position();
      body.css("top", 0).css("left", 0);
      var tx = pos.top + pos.height;
      var v1CompNum = pos.left + pos.width / 2 - body.outerWidth() / 2 + $(self.original_window).scrollLeft();
      if (!self.opts.iframe) {
        tx += $(self.original_window).scrollTop();
      }
      fn(v1CompNum, tx, body, pos.height);
    }
    /**
     * @param {?} left
     * @param {number} y
     * @param {Object} node
     * @param {number} next
     * @return {undefined}
     */
    function fn(left, y, node, next) {
      var scroller = node.data("container");
      if (scroller) {
        if ("BODY" != scroller.get(0).tagName) {
          if (left) {
            left -= scroller.offset().left;
          }
          if (y) {
            y -= scroller.offset().top - scroller.scrollTop();
          }
        }
      }
      if (self.opts.iframe) {
        if (scroller) {
          if (self.$tb) {
            if (scroller.get(0) != self.$tb.get(0)) {
              if (left) {
                left += self.$iframe.offset().left;
              }
              if (y) {
                y += self.$iframe.offset().top;
              }
            }
          }
        }
      }
      var x = move(node, left);
      if (left) {
        node.css("left", x);
        var body = node.find(".fr-arrow");
        if (!body.data("margin-left")) {
          body.data("margin-left", self.helpers.getPX(body.css("margin-left")));
        }
        body.css("margin-left", left - x + body.data("margin-left"));
      }
      if (y) {
        node.css("top", handler(node, y, next));
      }
    }
    /**
     * @param {?} selector
     * @return {undefined}
     */
    function init(selector) {
      var elem = $(selector);
      var e = elem.is(".fr-sticky-on");
      var check = elem.data("sticky-top");
      var currentValue = elem.data("sticky-scheduled");
      if ("undefined" == typeof check) {
        elem.data("sticky-top", 0);
        var $plum = $('<div class="fr-sticky-dummy" style="height: ' + elem.outerHeight() + 'px;"></div>');
        self.$box.prepend($plum);
      }
      if (self.core.hasFocus() || self.$tb.find("input:visible:focus").length > 0) {
        var height = $(window).scrollTop();
        /** @type {number} */
        var value = Math.min(Math.max(height - self.$tb.parent().offset().top, 0), self.$tb.parent().outerHeight() - elem.outerHeight());
        if (value != check) {
          if (value != currentValue) {
            clearTimeout(elem.data("sticky-timeout"));
            elem.data("sticky-scheduled", value);
            if (elem.outerHeight() < height - self.$tb.parent().offset().top) {
              elem.addClass("fr-opacity-0");
            }
            elem.data("sticky-timeout", setTimeout(function() {
              var parentHeight = $(window).scrollTop();
              /** @type {number} */
              var value = Math.min(Math.max(parentHeight - self.$tb.parent().offset().top, 0), self.$tb.parent().outerHeight() - elem.outerHeight());
              if (value > 0) {
                if ("BODY" == self.$tb.parent().get(0).tagName) {
                  value += self.$tb.parent().position().top;
                }
              }
              if (value != check) {
                elem.css("top", Math.max(value, 0));
                if (self.$tb.hasClass("fr-inline")) {
                  elem.css("top", height);
                }
                elem.data("sticky-top", value);
                elem.data("sticky-scheduled", value);
              }
              elem.removeClass("fr-opacity-0");
              if (self.$tb.hasClass("fr-inline")) {
                self.toolbar.show();
              }
            }, 100));
          }
        }
        if (!e) {
          elem.css("top", "0");
          elem.width(self.$tb.parent().width());
          elem.addClass("fr-sticky-on");
          self.$box.addClass("fr-sticky-box");
        }
      } else {
        clearTimeout($(selector).css("sticky-timeout"));
        elem.css("top", "0");
        elem.css("position", "");
        elem.width("");
        elem.data("sticky-top", 0);
        elem.removeClass("fr-sticky-on");
        self.$box.removeClass("fr-sticky-box");
        if (self.$tb.hasClass("fr-inline")) {
          self.toolbar.hide();
        }
      }
    }
    /**
     * @param {HTMLElement} target
     * @return {undefined}
     */
    function initialize(target) {
      if (target.offsetWidth) {
        var n;
        var c;
        var $this = $(target);
        var elemHeigth = $this.outerHeight();
        var value = $this.data("sticky-position");
        var b = $("body" == self.opts.scrollableContainer ? self.original_window : self.opts.scrollableContainer).outerHeight();
        /** @type {number} */
        var y = 0;
        /** @type {number} */
        var i = 0;
        if ("body" !== self.opts.scrollableContainer) {
          y = $(self.opts.scrollableContainer).offset().top;
          /** @type {number} */
          i = $(self.original_window).outerHeight() - y - b;
        }
        var a = "body" == self.opts.scrollableContainer ? $(self.original_window).scrollTop() : y;
        var m = $this.is(".fr-sticky-on");
        if (!$this.data("sticky-parent")) {
          $this.data("sticky-parent", $this.parent());
        }
        var image = $this.data("sticky-parent");
        var elemTop = image.offset().top;
        var elemHeight = image.outerHeight();
        if ($this.data("sticky-offset") || ($this.data("sticky-offset", true), $this.after('<div class="fr-sticky-dummy" style="height: ' + elemHeigth + 'px;"></div>')), !value) {
          /** @type {boolean} */
          var q = "auto" !== $this.css("top") || "auto" !== $this.css("bottom");
          if (!q) {
            $this.css("position", "fixed");
          }
          value = {
            top : "auto" !== $this.css("top"),
            bottom : "auto" !== $this.css("bottom")
          };
          if (!q) {
            $this.css("position", "");
          }
          $this.data("sticky-position", value);
          $this.data("top", $this.css("top"));
          $this.data("bottom", $this.css("bottom"));
        }
        /**
         * @return {?}
         */
        var isLocalStorageNameSupported = function() {
          return a + n > elemTop && elemTop + elemHeight - elemHeigth >= a + n;
        };
        /**
         * @return {?}
         */
        var _isArray = function() {
          return a + b - c > elemTop + elemHeigth && elemTop + elemHeight > a + b - c;
        };
        n = self.helpers.getPX($this.data("top"));
        c = self.helpers.getPX($this.data("bottom"));
        var program = value.top && isLocalStorageNameSupported();
        var inverse = value.bottom && _isArray();
        if (program || inverse) {
          $this.css("width", image.width() + "px");
          if (!m) {
            $this.addClass("fr-sticky-on");
            $this.removeClass("fr-sticky-off");
            if ($this.css("top")) {
              if ("auto" != $this.data("top")) {
                $this.css("top", self.helpers.getPX($this.data("top")) + y);
              } else {
                $this.data("top", "auto");
              }
            }
            if ($this.css("bottom")) {
              if ("auto" != $this.data("bottom")) {
                $this.css("bottom", self.helpers.getPX($this.data("bottom")) + i);
              } else {
                $this.css("bottom", "auto");
              }
            }
          }
        } else {
          if (!$this.hasClass("fr-sticky-off")) {
            $this.width("");
            $this.removeClass("fr-sticky-on");
            $this.addClass("fr-sticky-off");
            if ($this.css("top")) {
              if ("auto" != $this.css("top")) {
                $this.css("top", 0);
              }
            }
            if ($this.css("bottom")) {
              $this.css("bottom", 0);
            }
          }
        }
      }
    }
    /**
     * @return {?}
     */
    function complete() {
      /** @type {Element} */
      var elem = document.createElement("test");
      /** @type {(CSSStyleDeclaration|null)} */
      var options = elem.style;
      return options.cssText = "position:" + ["-webkit-", "-moz-", "-ms-", "-o-", ""].join("sticky; position:") + " sticky;", -1 !== options.position.indexOf("sticky") && (!self.helpers.isIOS() && !self.helpers.isAndroid());
    }
    /**
     * @return {undefined}
     */
    function start() {
      if (!complete()) {
        if (self._stickyElements = [], self.helpers.isIOS()) {
          /**
           * @return {undefined}
           */
          var loop = function() {
            self.helpers.requestAnimationFrame()(loop);
            /** @type {number} */
            var i = 0;
            for (;i < self._stickyElements.length;i++) {
              init(self._stickyElements[i]);
            }
          };
          loop();
          $(self.original_window).on("scroll.sticky" + self.id, function() {
            if (self.core.hasFocus()) {
              /** @type {number} */
              var i = 0;
              for (;i < self._stickyElements.length;i++) {
                var $target = $(self._stickyElements[i]);
                var pos0 = $target.parent();
                var documentHeight = $(window).scrollTop();
                if ($target.outerHeight() < documentHeight - pos0.offset().top) {
                  $target.addClass("fr-opacity-0");
                  $target.data("sticky-top", -1);
                  $target.data("sticky-scheduled", -1);
                }
              }
            }
          });
        } else {
          $("body" == self.opts.scrollableContainer ? self.original_window : self.opts.scrollableContainer).on("scroll.sticky" + self.id, hide);
          $(self.original_window).on("resize.sticky" + self.id, hide);
          self.events.on("initialized", hide);
          self.events.on("focus", hide);
          $(self.original_window).on("resize", "textarea", hide);
        }
      }
    }
    /**
     * @return {undefined}
     */
    function hide() {
      /** @type {number} */
      var i = 0;
      for (;i < self._stickyElements.length;i++) {
        initialize(self._stickyElements[i]);
      }
    }
    /**
     * @param {Node} resource
     * @return {undefined}
     */
    function done(resource) {
      resource.addClass("fr-sticky");
      if (self.helpers.isIOS()) {
        resource.addClass("fr-sticky-ios");
      }
      if (!complete()) {
        self._stickyElements.push(resource.get(0));
      }
    }
    /**
     * @return {undefined}
     */
    function match() {
      $(self.original_window).off("scroll.sticky" + self.id);
      $(self.original_window).off("resize.sticky" + self.id);
    }
    /**
     * @return {undefined}
     */
    function f() {
      start();
      self.events.on("destroy", match, true);
    }
    return{
      /** @type {function (): undefined} */
      _init : f,
      /** @type {function (Object): undefined} */
      forSelection : render,
      /** @type {function (Node): undefined} */
      addSticky : done,
      /** @type {function (): undefined} */
      refresh : hide,
      /** @type {function (?, number, Object, number): undefined} */
      at : fn,
      /** @type {function (): ?} */
      getBoundingRect : position
    };
  };
  $.extend($.FroalaEditor.DEFAULTS, {
    toolbarInline : false,
    toolbarVisibleWithoutSelection : true,
    toolbarSticky : true,
    toolbarButtons : ["fullscreen", "bold", "italic", "underline", "strikeThrough", "subscript", "superscript", "fontFamily", "fontSize", "|", "color", "emoticons", "inlineStyle", "paragraphStyle", "|", "paragraphFormat", "align", "formatOL", "formatUL", "outdent", "indent", "quote", "insertHR", "-", "insertLink", "insertImage", "insertVideo", "insertFile", "insertTable", "undo", "redo", "clearFormatting", "selectAll", "html"],
    toolbarButtonsXS : ["bold", "italic", "fontFamily", "fontSize", "|", "undo", "redo"],
    toolbarButtonsSM : ["bold", "italic", "underline", "|", "fontFamily", "fontSize", "insertLink", "insertImage", "table", "|", "undo", "redo"],
    toolbarButtonsMD : ["fullscreen", "bold", "italic", "underline", "fontFamily", "fontSize", "color", "paragraphStyle", "paragraphFormat", "align", "formatOL", "formatUL", "outdent", "indent", "quote", "insertHR", "-", "insertLink", "insertImage", "insertVideo", "insertFile", "insertTable", "undo", "redo", "clearFormatting"],
    toolbarStickyOffset : 0
  });
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.toolbar = function(self) {
    /**
     * @param {Array} results
     * @param {Array} arg
     * @return {undefined}
     */
    function log(results, arg) {
      /** @type {number} */
      var j = 0;
      for (;j < arg.length;j++) {
        if ("-" != arg[j]) {
          if ("|" != arg[j]) {
            if (results.indexOf(arg[j]) < 0) {
              results.push(arg[j]);
            }
          }
        }
      }
    }
    /**
     * @return {undefined}
     */
    function draw() {
      var list = $.merge([], keys());
      log(list, self.opts.toolbarButtonsXS || []);
      log(list, self.opts.toolbarButtonsSM || []);
      log(list, self.opts.toolbarButtonsMD || []);
      log(list, self.opts.toolbarButtons);
      /** @type {number} */
      var i = list.length - 1;
      for (;i >= 0;i--) {
        if ("-" != list[i]) {
          if ("|" != list[i]) {
            if (list.indexOf(list[i]) < i) {
              list.splice(i, 1);
            }
          }
        }
      }
      var sorted = self.button.buildList(list, keys());
      self.$tb.append(sorted);
      self.button.bindCommands(self.$tb);
    }
    /**
     * @return {?}
     */
    function keys() {
      var objUid = self.helpers.screenSize();
      return map[objUid];
    }
    /**
     * @return {undefined}
     */
    function start() {
      var codeSegments = keys();
      self.$tb.find(".fr-separator").remove();
      self.$tb.find("> .fr-command").addClass("fr-hidden");
      /** @type {number} */
      var i = 0;
      for (;i < codeSegments.length;i++) {
        if ("|" == codeSegments[i] || "-" == codeSegments[i]) {
          self.$tb.append(self.button.buildList([codeSegments[i]]));
        } else {
          var header = self.$tb.find('> .fr-command[data-cmd="' + codeSegments[i] + '"]');
          /** @type {null} */
          var option = null;
          if (header.next().hasClass("fr-dropdown-menu")) {
            option = header.next();
          }
          header.removeClass("fr-hidden").appendTo(self.$tb);
          if (option) {
            option.appendTo(self.$tb);
          }
        }
      }
    }
    /**
     * @return {undefined}
     */
    function _add() {
      $(self.original_window).on("resize.buttons." + self.id, start);
      $(self.original_window).on("orientationchange.buttons." + self.id, start);
    }
    /**
     * @param {Object} event
     * @param {boolean} dataAndEvents
     * @return {undefined}
     */
    function onSuccess(event, dataAndEvents) {
      if (self.helpers.isMobile()) {
        self.toolbar.show();
      } else {
        setTimeout(function() {
          if (event && event.which == $.FroalaEditor.KEYCODE.ESC) {
          } else {
            if (self.selection.inEditor() && (self.core.hasFocus() && (!self.popups.areVisible() && (self.opts.toolbarVisibleWithoutSelection && (event && "keyup" != event.type) || (!self.selection.isCollapsed() && !self.keys.isIME() || dataAndEvents))))) {
              if (0 == self.events.trigger("toolbar.show")) {
                return false;
              }
              if (!self.helpers.isMobile()) {
                self.position.forSelection(self.$tb);
              }
              self.$tb.show();
            }
          }
        }, 0);
      }
    }
    /**
     * @return {?}
     */
    function hide() {
      return 0 == self.events.trigger("toolbar.hide") ? false : void self.$tb.hide();
    }
    /**
     * @return {?}
     */
    function show() {
      return 0 == self.events.trigger("toolbar.show") ? false : void self.$tb.show();
    }
    /**
     * @return {undefined}
     */
    function create() {
      self.events.on("window.mousedown", hide);
      self.events.on("keydown", hide);
      self.events.on("blur", hide);
      self.events.on("window.mouseup", onSuccess);
      self.events.on("window.keyup", onSuccess);
      self.events.on("keydown", function(e) {
        if (e) {
          if (e.which == $.FroalaEditor.KEYCODE.ESC) {
            hide();
          }
        }
      });
      self.$wp.on("scroll.toolbar", onSuccess);
      self.events.on("commands.after", onSuccess);
    }
    /**
     * @return {undefined}
     */
    function addEvent() {
      self.events.on("focus", onSuccess, true);
      self.events.on("blur", hide, true);
    }
    /**
     * @return {undefined}
     */
    function render() {
      if (self.opts.toolbarInline) {
        self.$box.addClass("fr-inline");
        if (self.helpers.isMobile()) {
          if (self.helpers.isIOS()) {
            $(self.opts.scrollableContainer).prepend(self.$tb);
            self.position.addSticky(self.$tb);
          } else {
            self.$tb.addClass("fr-bottom");
            self.$box.append(self.$tb);
            self.position.addSticky(self.$tb);
            /** @type {boolean} */
            self.opts.toolbarBottom = true;
          }
          self.$tb.addClass("fr-inline");
          addEvent();
          /** @type {boolean} */
          self.opts.toolbarInline = false;
        } else {
          $(self.opts.scrollableContainer).append(self.$tb);
          self.$tb.data("container", $(self.opts.scrollableContainer));
          self.$tb.addClass("fr-inline");
          self.$tb.prepend('<span class="fr-arrow"></span>');
          create();
          /** @type {boolean} */
          self.opts.toolbarBottom = false;
        }
      } else {
        if (self.opts.toolbarBottom && !self.helpers.isIOS()) {
          self.$box.append(self.$tb);
          self.$tb.addClass("fr-bottom");
          self.$box.addClass("fr-bottom");
        } else {
          /** @type {boolean} */
          self.opts.toolbarBottom = false;
          self.$box.prepend(self.$tb);
          self.$tb.addClass("fr-top");
          self.$box.addClass("fr-top");
        }
        self.$box.addClass("fr-basic");
        self.$tb.addClass("fr-basic");
        if (self.opts.toolbarSticky) {
          if (self.opts.toolbarStickyOffset) {
            if (self.opts.toolbarBottom) {
              self.$tb.css("bottom", self.opts.toolbarStickyOffset);
            } else {
              self.$tb.css("top", self.opts.toolbarStickyOffset);
            }
          }
          self.position.addSticky(self.$tb);
        }
      }
    }
    /**
     * @return {undefined}
     */
    function reset() {
      $(self.original_window).off("resize.buttons." + self.id);
      $(self.original_window).off("orientationchange.buttons." + self.id);
      self.$box.removeClass("fr-top fr-bottom fr-inline fr-basic");
      self.$box.find(".fr-sticky-dummy").remove();
      self.$tb.off(self._mousedown + " " + self._mouseup);
      self.$tb.html("").removeData().remove();
    }
    /**
     * @return {?}
     */
    function init() {
      return self.$wp ? (self.$tb = $('<div class="fr-toolbar"></div>'), self.opts.theme && self.$tb.addClass(self.opts.theme + "-theme"), self.opts.zIndex > 1 && self.$tb.css("z-index", self.opts.zIndex + 1), "auto" != self.opts.direction && self.$tb.removeClass("fr-ltr fr-rtl").addClass("fr-" + self.opts.direction), self.helpers.isMobile() ? self.$tb.addClass("fr-mobile") : self.$tb.addClass("fr-desktop"), render(), doc = self.$tb.get(0).ownerDocument, s = "defaultView" in doc ? doc.defaultView : 
      doc.parentWindow, draw(), _add(), self.$tb.on(self._mousedown + " " + self._mouseup, function(e) {
        var offsetParent = e.originalEvent ? e.originalEvent.target || e.originalEvent.originalTarget : null;
        return offsetParent && "INPUT" != offsetParent.tagName ? (e.stopPropagation(), e.preventDefault(), false) : void 0;
      }), void self.events.on("destroy", reset, true)) : false;
    }
    /**
     * @return {undefined}
     */
    function disable() {
      if (!u) {
        if (self.$tb) {
          self.$tb.find("> .fr-command").addClass("fr-disabled fr-no-refresh");
          /** @type {boolean} */
          u = true;
        }
      }
    }
    /**
     * @return {undefined}
     */
    function toggle() {
      if (u) {
        if (self.$tb) {
          self.$tb.find("> .fr-command").removeClass("fr-disabled fr-no-refresh");
          /** @type {boolean} */
          u = false;
        }
      }
      self.button.bulkRefresh();
    }
    var doc;
    var s;
    /** @type {Array} */
    var map = [];
    map[$.FroalaEditor.XS] = self.opts.toolbarButtonsXS || self.opts.toolbarButtons;
    map[$.FroalaEditor.SM] = self.opts.toolbarButtonsSM || self.opts.toolbarButtons;
    map[$.FroalaEditor.MD] = self.opts.toolbarButtonsMD || self.opts.toolbarButtons;
    map[$.FroalaEditor.LG] = self.opts.toolbarButtons;
    /** @type {boolean} */
    var u = false;
    return{
      /** @type {function (): ?} */
      _init : init,
      /** @type {function (): ?} */
      hide : hide,
      /** @type {function (): ?} */
      show : show,
      /** @type {function (Object, boolean): undefined} */
      showInline : onSuccess,
      /** @type {function (): undefined} */
      disable : disable,
      /** @type {function (): undefined} */
      enable : toggle
    };
  };
  $.FroalaEditor.SHORTCUTS_MAP = {
    69 : {
      cmd : "show"
    },
    66 : {
      cmd : "bold"
    },
    73 : {
      cmd : "italic"
    },
    85 : {
      cmd : "underline"
    },
    83 : {
      cmd : "strikeThrough"
    },
    221 : {
      cmd : "indent"
    },
    219 : {
      cmd : "outdent"
    },
    90 : {
      cmd : "undo"
    },
    "-90" : {
      cmd : "redo"
    }
  };
  $.extend($.FroalaEditor.DEFAULTS, {
    shortcutsEnabled : ["show", "bold", "italic", "underline", "strikeThrough", "indent", "outdent", "undo", "redo"]
  });
  /**
   * @param {number} dataAndEvents
   * @param {string} cmd
   * @param {string} n
   * @param {boolean} deepDataAndEvents
   * @return {undefined}
   */
  $.FroalaEditor.RegisterShortcut = function(dataAndEvents, cmd, n, deepDataAndEvents) {
    $.FroalaEditor.SHORTCUTS_MAP[dataAndEvents * (deepDataAndEvents ? -1 : 1)] = {
      cmd : cmd,
      val : n
    };
    $.FroalaEditor.DEFAULTS.shortcutsEnabled.push(cmd);
  };
  /**
   * @param {Object} e
   * @return {?}
   */
  $.FroalaEditor.MODULES.shortcuts = function(e) {
    /**
     * @param {Event} event
     * @return {?}
     */
    function start(event) {
      var keycode = event.which;
      if (e.keys.ctrlKey(event) && (event.shiftKey && $.FroalaEditor.SHORTCUTS_MAP[-keycode] || !event.shiftKey && $.FroalaEditor.SHORTCUTS_MAP[keycode])) {
        var type = $.FroalaEditor.SHORTCUTS_MAP[keycode * (event.shiftKey ? -1 : 1)].cmd;
        if (type && e.opts.shortcutsEnabled.indexOf(type) >= 0) {
          var i;
          var val = $.FroalaEditor.SHORTCUTS_MAP[keycode * (event.shiftKey ? -1 : 1)].val;
          if (type && !val ? i = e.$tb.find('.fr-command[data-cmd="' + type + '"]') : type && (val && (i = e.$tb.find('.fr-command[data-cmd="' + type + '"][data-param0="' + val + '"]'))), i.length) {
            return event.preventDefault(), event.stopPropagation(), "keydown" == event.type && e.button.exec(i), false;
          }
          if (type && e.commands[type]) {
            return event.preventDefault(), event.stopPropagation(), "keydown" == event.type && e.commands[type](), false;
          }
        }
      }
    }
    /**
     * @return {undefined}
     */
    function setup() {
      e.events.on("keydown", start, true);
      e.events.on("keyup", start, true);
    }
    return{
      /** @type {function (): undefined} */
      _init : setup
    };
  };
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.snapshot = function(self) {
    /**
     * @param {Element} el
     * @return {?}
     */
    function next(el) {
      var nodes = el.parentNode.childNodes;
      /** @type {number} */
      var rv = 0;
      /** @type {null} */
      var node = null;
      /** @type {number} */
      var i = 0;
      for (;i < nodes.length;i++) {
        if (node) {
          /** @type {boolean} */
          var f = nodes[i].nodeType === Node.TEXT_NODE && "" === nodes[i].textContent;
          /** @type {boolean} */
          var g = node.nodeType === Node.TEXT_NODE && nodes[i].nodeType === Node.TEXT_NODE;
          if (!f) {
            if (!g) {
              rv++;
            }
          }
        }
        if (nodes[i] == el) {
          return rv;
        }
        node = nodes[i];
      }
    }
    /**
     * @param {Element} el
     * @return {?}
     */
    function handle(el) {
      /** @type {Array} */
      var matched = [];
      if (!el.parentNode) {
        return[];
      }
      for (;!self.node.isElement(el);) {
        matched.push(next(el));
        el = el.parentNode;
      }
      return matched.reverse();
    }
    /**
     * @param {string} node
     * @param {?} offset
     * @return {?}
     */
    function isSplitPoint(node, offset) {
      for (;node && node.nodeType === Node.TEXT_NODE;) {
        var parent = node.previousSibling;
        if (parent) {
          if (parent.nodeType == Node.TEXT_NODE) {
            offset += parent.textContent.length;
          }
        }
        node = parent;
      }
      return offset;
    }
    /**
     * @param {Object} range
     * @return {?}
     */
    function fn(range) {
      return{
        scLoc : handle(range.startContainer),
        scOffset : isSplitPoint(range.startContainer, range.startOffset),
        ecLoc : handle(range.endContainer),
        ecOffset : isSplitPoint(range.endContainer, range.endOffset)
      };
    }
    /**
     * @return {?}
     */
    function init() {
      var $scope = {};
      if (self.events.trigger("snapshot.before"), $scope.html = self.$el.html(), $scope.ranges = [], self.selection.inEditor() && self.core.hasFocus()) {
        var codeSegments = self.selection.ranges();
        /** @type {number} */
        var i = 0;
        for (;i < codeSegments.length;i++) {
          $scope.ranges.push(fn(codeSegments[i]));
        }
      }
      return self.events.trigger("snapshot.after"), $scope;
    }
    /**
     * @param {Array} codeSegments
     * @return {?}
     */
    function clone(codeSegments) {
      var element = self.$el.get(0);
      /** @type {number} */
      var i = 0;
      for (;i < codeSegments.length;i++) {
        element = element.childNodes[codeSegments[i]];
      }
      return element;
    }
    /**
     * @param {Selection} sel
     * @param {?} node
     * @return {undefined}
     */
    function select(sel, node) {
      try {
        var textNode1 = clone(node.scLoc);
        var len = node.scOffset;
        var text2 = clone(node.ecLoc);
        var index = node.ecOffset;
        var range = self.document.createRange();
        range.setStart(textNode1, len);
        range.setEnd(text2, index);
        sel.addRange(range);
      } catch (j) {
      }
    }
    /**
     * @param {Object} attrs
     * @return {undefined}
     */
    function start(attrs) {
      if (self.$el.html() != attrs.html) {
        self.$el.html(attrs.html);
      }
      var sel = self.selection.get();
      self.selection.clear();
      self.events.focus(true);
      /** @type {number} */
      var i = 0;
      for (;i < attrs.ranges.length;i++) {
        select(sel, attrs.ranges[i]);
      }
    }
    /**
     * @param {Object} $scope
     * @param {Object} e
     * @return {?}
     */
    function errorHandler($scope, e) {
      return $scope.html != e.html ? false : JSON.stringify($scope.ranges) != JSON.stringify(e.ranges) ? false : true;
    }
    return{
      /** @type {function (): ?} */
      get : init,
      /** @type {function (Object): undefined} */
      restore : start,
      /** @type {function (Object, Object): ?} */
      equal : errorHandler
    };
  };
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.undo = function(self) {
    /**
     * @param {Event} e
     * @return {undefined}
     */
    function keydown(e) {
      var key = e.which;
      var coord = self.keys.ctrlKey(e);
      if (coord) {
        if (90 == key) {
          if (e.shiftKey) {
            e.preventDefault();
          }
        }
        if (90 == key) {
          e.preventDefault();
        }
      }
    }
    /**
     * @return {?}
     */
    function undo() {
      return 0 === self.undo_stack.length || self.undo_index <= 1 ? false : true;
    }
    /**
     * @return {?}
     */
    function promote() {
      return self.undo_index == self.undo_stack.length ? false : true;
    }
    /**
     * @param {Object} e
     * @return {?}
     */
    function error(e) {
      if (!self.undo_stack || self.undoing) {
        return false;
      }
      for (;self.undo_stack.length > self.undo_index;) {
        self.undo_stack.pop();
      }
      if ("undefined" == typeof e) {
        e = self.snapshot.get();
        if (!(self.undo_stack[self.undo_index - 1] && self.snapshot.equal(self.undo_stack[self.undo_index - 1], e))) {
          self.undo_stack.push(e);
          self.undo_index++;
          if (e.html != s) {
            self.events.trigger("contentChanged");
            s = e.html;
          }
        }
      } else {
        if (self.undo_index > 0) {
          /** @type {Object} */
          self.undo_stack[self.undo_index - 1] = e;
        } else {
          self.undo_stack.push(e);
          self.undo_index++;
        }
      }
    }
    /**
     * @return {undefined}
     */
    function toggle() {
      if (self.undo_index > 1) {
        /** @type {boolean} */
        self.undoing = true;
        var validObj = self.undo_stack[--self.undo_index - 1];
        clearTimeout(self._content_changed_timer);
        self.snapshot.restore(validObj);
        self.popups.hideAll();
        self.toolbar.enable();
        self.events.trigger("contentChanged");
        self.events.trigger("commands.undo");
        /** @type {boolean} */
        self.undoing = false;
      }
    }
    /**
     * @return {undefined}
     */
    function render() {
      if (self.undo_index < self.undo_stack.length) {
        /** @type {boolean} */
        self.undoing = true;
        var validObj = self.undo_stack[self.undo_index++];
        clearTimeout(self._content_changed_timer);
        self.snapshot.restore(validObj);
        self.popups.hideAll();
        self.toolbar.enable();
        self.events.trigger("contentChanged");
        self.events.trigger("commands.redo");
        /** @type {boolean} */
        self.undoing = false;
      }
    }
    /**
     * @return {undefined}
     */
    function spy() {
      /** @type {number} */
      self.undo_index = 0;
      /** @type {Array} */
      self.undo_stack = [];
    }
    /**
     * @return {undefined}
     */
    function initialize() {
      spy();
      self.events.on("initialized", function() {
        s = self.html.get(false, true);
      });
      self.events.on("keydown", keydown);
    }
    /** @type {null} */
    var s = null;
    return{
      /** @type {function (): undefined} */
      _init : initialize,
      /** @type {function (): undefined} */
      run : toggle,
      /** @type {function (): undefined} */
      redo : render,
      /** @type {function (): ?} */
      canDo : undo,
      /** @type {function (): ?} */
      canRedo : promote,
      /** @type {function (): undefined} */
      reset : spy,
      /** @type {function (Object): ?} */
      saveStep : error
    };
  };
  $.FroalaEditor.POPUP_TEMPLATES = {
    "text.edit" : "[_EDIT_]"
  };
  /**
   * @param {?} i
   * @param {?} offsetPosition
   * @return {undefined}
   */
  $.FroalaEditor.RegisterTemplate = function(i, offsetPosition) {
    $.FroalaEditor.POPUP_TEMPLATES[i] = offsetPosition;
  };
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.popups = function(self) {
    /**
     * @param {string} name
     * @param {Object} list
     * @return {undefined}
     */
    function render(name, list) {
      nodes[name].data("container", list);
      list.append(nodes[name]);
    }
    /**
     * @param {string} i
     * @param {?} x
     * @param {number} y
     * @param {number} positions
     * @return {?}
     */
    function show(i, x, y, positions) {
      if (log() && (self.$el.find(".fr-marker").length > 0 && (self.events.disableBlur(), self.selection.restore())), callback([i]), !nodes[i]) {
        return false;
      }
      var _barWidth = nodes[i].outerWidth();
      var k = (nodes[i].outerHeight(), has(i));
      nodes[i].addClass("fr-active").find("input, textarea").removeAttr("disabled");
      var bounds = nodes[i].data("container");
      if (self.opts.toolbarInline) {
        if (bounds) {
          if (self.$tb) {
            if (bounds.get(0) == self.$tb.get(0)) {
              render(i, self.opts.toolbarInline ? $(self.opts.scrollableContainer) : self.$box);
              if (y) {
                /** @type {number} */
                y = self.$tb.offset().top - self.helpers.getPX(self.$tb.css("margin-top"));
              }
              if (x) {
                x = self.$tb.offset().left + self.$tb.width() / 2;
              }
              if (self.$tb.hasClass("fr-above")) {
                y += self.$tb.outerHeight();
              }
              /** @type {number} */
              positions = 0;
            }
          }
        }
      }
      bounds = nodes[i].data("container");
      if (!!self.opts.iframe) {
        if (!positions) {
          if (!k) {
            if (x) {
              x -= self.$iframe.offset().left;
            }
            if (y) {
              y -= self.$iframe.offset().top;
            }
          }
        }
      }
      if (x) {
        x -= _barWidth / 2;
      }
      if (self.opts.toolbarBottom) {
        if (bounds) {
          if (self.$tb) {
            if (bounds.get(0) == self.$tb.get(0)) {
              nodes[i].addClass("fr-above");
              y -= nodes[i].outerHeight();
            }
          }
        }
      }
      self.position.at(x, y, nodes[i], positions || 0);
      var selectedElement = nodes[i].find("input:visible, textarea:visible").get(0);
      if (selectedElement) {
        if (0 == self.$el.find(".fr-marker").length) {
          if (self.core.hasFocus()) {
            self.selection.save();
          }
        }
        self.events.disableBlur();
        $(selectedElement).select().focus();
      }
      if (self.opts.toolbarInline) {
        if (!self.helpers.isMobile()) {
          self.toolbar.hide();
        }
      }
      self.events.trigger("popups.show." + i);
    }
    /**
     * @param {string} event
     * @param {Function} sender
     * @return {undefined}
     */
    function execute(event, sender) {
      self.events.on("popups.show." + event, sender);
    }
    /**
     * @param {string} i
     * @return {?}
     */
    function has(i) {
      return nodes[i] && nodes[i].hasClass("fr-active") || false;
    }
    /**
     * @return {?}
     */
    function log() {
      var name;
      for (name in nodes) {
        if (has(name)) {
          return true;
        }
      }
      return false;
    }
    /**
     * @param {string} i
     * @return {undefined}
     */
    function f(i) {
      if (nodes[i]) {
        if (nodes[i].hasClass("fr-active")) {
          nodes[i].removeClass("fr-active fr-above");
          self.events.trigger("popups.hide." + i);
          self.events.disableBlur();
          nodes[i].find("input, textarea, button").filter(":focus").blur();
          nodes[i].find("input, textarea").attr("disabled", "disabled");
        }
      }
    }
    /**
     * @param {string} eventName
     * @param {Function} capture
     * @return {undefined}
     */
    function addEvent(eventName, capture) {
      self.events.on("popups.hide." + eventName, capture);
    }
    /**
     * @param {number} mayParseLabeledStatementInstead
     * @return {?}
     */
    function eatExpressions(mayParseLabeledStatementInstead) {
      return nodes[mayParseLabeledStatementInstead];
    }
    /**
     * @param {string} event
     * @param {Function} one
     * @return {undefined}
     */
    function on(event, one) {
      self.events.on("popups.refresh." + event, one);
    }
    /**
     * @param {string} i
     * @return {undefined}
     */
    function onclick(i) {
      self.events.trigger("popups.refresh." + i);
      var list = nodes[i].find(".fr-command");
      /** @type {number} */
      var j = 0;
      for (;j < list.length;j++) {
        var e = $(list[j]);
        if (0 == e.parents(".fr-dropdown-menu").length) {
          self.button.refresh(e);
        }
      }
    }
    /**
     * @param {Array} e
     * @return {undefined}
     */
    function callback(e) {
      if ("undefined" == typeof e) {
        /** @type {Array} */
        e = [];
      }
      var name;
      for (name in nodes) {
        if (e.indexOf(name) < 0) {
          f(name);
        }
      }
    }
    /**
     * @return {undefined}
     */
    function rvar() {
      /** @type {boolean} */
      u = true;
    }
    /**
     * @return {undefined}
     */
    function methodName() {
      /** @type {boolean} */
      u = false;
    }
    /**
     * @param {string} name
     * @param {Object} obj
     * @return {?}
     */
    function get(name, obj) {
      var fn = $.FroalaEditor.POPUP_TEMPLATES[name];
      if ("function" == typeof fn) {
        fn = fn.apply(self);
      }
      var key;
      for (key in obj) {
        fn = fn.replace("[_" + key.toUpperCase() + "_]", obj[key]);
      }
      return fn;
    }
    /**
     * @param {string} name
     * @param {Object} selector
     * @return {?}
     */
    function init(name, selector) {
      var values = get(name, selector);
      var node = $('<div class="fr-popup' + (self.helpers.isMobile() ? " fr-mobile" : " fr-desktop") + (self.opts.toolbarInline ? " fr-inline" : "") + '"><span class="fr-arrow"></span>' + values + "</div>");
      if (self.opts.theme) {
        node.addClass(self.opts.theme + "-theme");
      }
      if (self.opts.zIndex > 1) {
        self.$tb.css("z-index", self.opts.zIndex + 2);
      }
      if ("auto" != self.opts.direction) {
        node.removeClass("fr-ltr fr-rtl").addClass("fr-" + self.opts.direction);
      }
      node.find("input, textarea").attr("dir", self.opts.direction).attr("disabled", "disabled");
      var style = $("body");
      return style.append(node), node.data("container", style), nodes[name] = node, self.button.bindCommands(node, false), $(self.original_window).on("resize.popups" + self.id, function() {
        if (!self.helpers.isMobile()) {
          self.events.disableBlur();
          f(name);
          self.events.enableBlur();
        }
      }), node.on(self._mousedown + " " + self._mouseup, function(e) {
        var offsetParent = e.originalEvent ? e.originalEvent.target || e.originalEvent.originalTarget : null;
        return offsetParent && "INPUT" != offsetParent.tagName ? (e.preventDefault(), e.stopPropagation(), false) : void e.stopPropagation();
      }), node.on("focus", "input, textarea, button, select", function(event) {
        if (event.preventDefault(), event.stopPropagation(), setTimeout(function() {
          self.events.enableBlur();
        }, 0), self.helpers.isMobile()) {
          var oldScrollTop = $(self.original_window).scrollTop();
          setTimeout(function() {
            $(self.original_window).scrollTop(oldScrollTop);
          }, 0);
        }
      }), node.on("keydown", "input, textarea, button, select", function(event) {
        var key = event.which;
        if ($.FroalaEditor.KEYCODE.TAB == key) {
          event.preventDefault();
          var children = node.find("input, textarea, button, select").filter(":visible").not(":disabled").toArray();
          children.sort(function(ctx, param) {
            return event.shiftKey ? $(ctx).attr("tabIndex") < $(param).attr("tabIndex") : $(ctx).attr("tabIndex") > $(param).attr("tabIndex");
          });
          self.events.disableBlur();
          var index = children.indexOf(this) + 1;
          if (index == children.length) {
            /** @type {number} */
            index = 0;
          }
          $(children[index]).focus();
        }
        if ($.FroalaEditor.KEYCODE.ENTER == key) {
          if (node.find(".fr-submit:visible").length > 0) {
            event.preventDefault();
            event.stopPropagation();
            self.events.disableBlur();
            self.button.exec(node.find(".fr-submit:visible:first"));
          }
        } else {
          if ($.FroalaEditor.KEYCODE.ESC == key) {
            return event.preventDefault(), event.stopPropagation(), self.$el.find(".fr-marker") && (self.events.disableBlur(), $(this).data("skip", true), self.selection.restore(), self.events.enableBlur()), has(name) && node.find(".fr-back:visible").length ? self.button.exec(node.find(".fr-back:visible:first")) : f(name), self.opts.toolbarInline && self.toolbar.showInline(null, true), false;
          }
          event.stopPropagation();
        }
      }), self.events.on("window.keydown", function(e) {
        var key = e.which;
        if ($.FroalaEditor.KEYCODE.ESC == key) {
          if (has(name) && self.opts.toolbarInline) {
            return e.stopPropagation(), has(name) && node.find(".fr-back:visible").length ? self.button.exec(node.find(".fr-back:visible:first")) : (f(name), self.toolbar.showInline(null, true)), false;
          }
          if (has(name) && node.find(".fr-back:visible").length) {
            self.button.exec(node.find(".fr-back:visible:first"));
          } else {
            f(name);
          }
        }
      }), self.$wp && (self.events.on("keydown", function(e) {
        if (!self.keys.ctrlKey(e)) {
          if (!(e.which == $.FroalaEditor.KEYCODE.ESC)) {
            if (has(name) && node.find(".fr-back:visible").length) {
              self.button.exec(node.find(".fr-back:visible:first"));
            } else {
              f(name);
            }
          }
        }
      }), node.on("blur", "input, textarea, button, select", function(dataAndEvents) {
        if (document.activeElement != this) {
          if ($(this).is(":visible")) {
            if (self.events.blurActive()) {
              self.events.trigger("blur");
            }
            self.events.enableBlur();
          }
        }
      })), node.on("mousedown touchstart touch", "*", function(e) {
        if (["INPUT", "TEXTAREA", "BUTTON", "SELECT", "LABEL"].indexOf(e.currentTarget.tagName) >= 0) {
          e.stopPropagation();
        }
        self.events.disableBlur();
      }), self.events.on("mouseup", function(dataAndEvents) {
        if (node.is(":visible")) {
          if (u) {
            if (node.find("input:focus, textarea:focus, button:focus, select:focus").filter(":visible").length > 0) {
              self.events.disableBlur();
            }
          }
        }
      }, true), self.events.on("window.mouseup", function(event) {
        if (node.is(":visible")) {
          if (u) {
            event.stopPropagation();
            self.markers.remove();
            f(name);
          }
        }
      }, true), self.events.on("blur", function(dataAndEvents) {
        callback();
      }), node.on("keydown keyup change input", "input, textarea", function(dataAndEvents) {
        var codeSegments = $(this).next();
        if (0 == codeSegments.length) {
          $(this).after("<span>" + $(this).attr("placeholder") + "</span>");
        }
        $(this).toggleClass("fr-not-empty", "" != $(this).val());
      }), self.$wp && (!self.helpers.isMobile() && self.$wp.on("scroll.popup" + name, function(dataAndEvents) {
        if (has(name) && node.parent().get(0) == $(self.opts.scrollableContainer).get(0)) {
          /** @type {number} */
          var width = node.offset().top - self.$wp.offset().top;
          var height = (self.$wp.scrollTop(), self.$wp.outerHeight());
          if (width > height || 0 > width) {
            node.addClass("fr-hidden");
          } else {
            node.removeClass("fr-hidden");
          }
        }
      })), self.helpers.isIOS() && node.on("touchend", "label", function() {
        $("#" + $(this).attr("for")).prop("checked", function(dataAndEvents, deepDataAndEvents) {
          return!deepDataAndEvents;
        });
      }), node;
    }
    /**
     * @return {undefined}
     */
    function destroy() {
      var id;
      for (id in nodes) {
        var element = nodes[id];
        element.off("mousedown mouseup touchstart touchend");
        element.off("focus", "input, textarea, button, select");
        element.off("keydown", "input, textarea, button, select");
        element.off("blur", "input, textarea, button, select");
        element.off("keydown keyup change", "input, textarea");
        element.off(self._mousedown, "*");
        element.html("").removeData().remove();
        $(self.original_window).off("resize.popups" + self.id);
        if (self.$wp) {
          self.$wp.off("scroll.popup" + id);
        }
      }
    }
    /**
     * @return {undefined}
     */
    function setup() {
      self.events.on("destroy", destroy, true);
      self.events.on("window.mousedown", rvar);
      self.events.on("window.touchmove", methodName);
      self.events.on("mousedown", function(dataAndEvents) {
        if (log()) {
          self.$el.find(".fr-marker").remove();
        }
      });
      self.events.on("window.mouseup", function() {
        /** @type {boolean} */
        u = false;
      });
    }
    var nodes = {};
    /** @type {boolean} */
    var u = false;
    return{
      /** @type {function (): undefined} */
      _init : setup,
      /** @type {function (string, Object): ?} */
      create : init,
      /** @type {function (number): ?} */
      get : eatExpressions,
      /** @type {function (string, ?, number, number): ?} */
      show : show,
      /** @type {function (string): undefined} */
      hide : f,
      /** @type {function (string, Function): undefined} */
      onHide : addEvent,
      /** @type {function (Array): undefined} */
      hideAll : callback,
      /** @type {function (string, Object): undefined} */
      setContainer : render,
      /** @type {function (string): undefined} */
      refresh : onclick,
      /** @type {function (string, Function): undefined} */
      onRefresh : on,
      /** @type {function (string, Function): undefined} */
      onShow : execute,
      /** @type {function (string): ?} */
      isVisible : has,
      /** @type {function (): ?} */
      areVisible : log
    };
  };
  /**
   * @param {Object} options
   * @return {?}
   */
  $.FroalaEditor.MODULES.refresh = function(options) {
    /**
     * @param {Node} status
     * @param {?} cmd
     * @return {undefined}
     */
    function complete(status, cmd) {
      try {
        if (options.document.queryCommandState(cmd) === true) {
          status.addClass("fr-active");
        }
      } catch (d) {
      }
    }
    /**
     * @param {HTMLElement} context
     * @return {undefined}
     */
    function draw(context) {
      context.toggleClass("fr-disabled", !options.undo.canDo());
    }
    /**
     * @param {HTMLElement} editor
     * @return {undefined}
     */
    function refreshButtons(editor) {
      editor.toggleClass("fr-disabled", !options.undo.canRedo());
    }
    /**
     * @param {Object} text
     * @return {?}
     */
    function finish(text) {
      if (text.hasClass("fr-no-refresh")) {
        return false;
      }
      var codeSegments = options.selection.blocks();
      /** @type {number} */
      var i = 0;
      for (;i < codeSegments.length;i++) {
        if ("LI" != codeSegments[i].tagName || codeSegments[i].previousSibling) {
          return text.removeClass("fr-disabled"), true;
        }
        text.addClass("fr-disabled");
      }
    }
    /**
     * @param {Object} player
     * @return {?}
     */
    function init(player) {
      if (player.hasClass("fr-no-refresh")) {
        return false;
      }
      var j = options.selection.blocks();
      /** @type {number} */
      var i = 0;
      for (;i < j.length;i++) {
        /** @type {string} */
        var which = "rtl" == options.opts.direction || "rtl" == $(j[i]).css("direction") ? "margin-right" : "margin-left";
        if ("LI" == j[i].tagName || "LI" == j[i].parentNode.tagName) {
          return player.removeClass("fr-disabled"), true;
        }
        if (options.helpers.getPX($(j[i]).css(which)) > 0) {
          return player.removeClass("fr-disabled"), true;
        }
      }
      player.addClass("fr-disabled");
    }
    return{
      /** @type {function (Node, ?): undefined} */
      "default" : complete,
      /** @type {function (HTMLElement): undefined} */
      undo : draw,
      /** @type {function (HTMLElement): undefined} */
      redo : refreshButtons,
      /** @type {function (Object): ?} */
      outdent : init,
      /** @type {function (Object): ?} */
      indent : finish
    };
  };
  $.extend($.FroalaEditor.DEFAULTS, {
    editInPopup : false
  });
  /**
   * @param {Object} self
   * @return {?}
   */
  $.FroalaEditor.MODULES.textEdit = function(self) {
    /**
     * @return {undefined}
     */
    function reset() {
      /** @type {string} */
      var edit = '<div id="fr-text-edit-' + self.id + '" class="fr-layer fr-text-edit-layer"><div class="fr-input-line"><input type="text" placeholder="' + self.language.translate("Text") + '" tabIndex="1"></div><div class="fr-action-buttons"><button type="button" class="fr-command fr-submit" data-cmd="updateText" tabIndex="2">' + self.language.translate("Update") + "</button></div></div>";
      var className = {
        edit : edit
      };
      self.popups.create("text.edit", className);
    }
    /**
     * @return {undefined}
     */
    function init() {
      var invalidStr;
      var $page = self.popups.get("text.edit");
      invalidStr = "INPUT" === self.$el.prop("tagName") ? self.$el.attr("placeholder") : self.$el.text();
      $page.find("input").val(invalidStr).trigger("change");
      self.popups.setContainer("text.edit", $("body"));
      self.popups.show("text.edit", self.$el.offset().left + self.$el.outerWidth() / 2, self.$el.offset().top + self.$el.outerHeight(), self.$el.outerHeight());
    }
    /**
     * @return {undefined}
     */
    function done() {
      self.$el.on(self._mouseup, function(dataAndEvents) {
        setTimeout(function() {
          init();
        }, 10);
      });
    }
    /**
     * @return {undefined}
     */
    function update() {
      var $page = self.popups.get("text.edit");
      var newValue = $page.find("input").val();
      if (0 == newValue.length) {
        newValue = self.opts.placeholderText;
      }
      if ("INPUT" === self.$el.prop("tagName")) {
        self.$el.attr("placeholder", newValue);
      } else {
        self.$el.text(newValue);
      }
      self.events.trigger("contentChanged");
      self.popups.hide("text.edit");
    }
    /**
     * @return {undefined}
     */
    function complete() {
      if (self.opts.editInPopup) {
        reset();
        done();
      }
    }
    return{
      /** @type {function (): undefined} */
      _init : complete,
      /** @type {function (): undefined} */
      update : update
    };
  };
  $.FroalaEditor.RegisterCommand("updateText", {
    focus : false,
    undo : false,
    /**
     * @return {undefined}
     */
    callback : function() {
      this.textEdit.update();
    }
  });
});
