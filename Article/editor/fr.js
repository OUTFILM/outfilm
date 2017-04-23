
if ("undefined" == typeof jQuery) {
  throw new Error("Froala requires jQuery");
}! function($) {
  /**
   * @param {Node} element
   * @param {boolean} options
   * @return {?}
   */
  var self = function(element, options) {
    return this.options = $.extend({}, self.DEFAULTS, $(element).data(), "object" == typeof options && options), this.options.unsupportedAgents.test(navigator.userAgent) ? false : (this.valid_nodes = $.merge([], self.VALID_NODES), this.valid_nodes = $.merge(this.valid_nodes, $.map(Object.keys(this.options.blockTags), function(letter) {
      return letter.toUpperCase();
    })), this.browser = self.browser(), this.disabledList = [], this._id = ++self.count, this._events = {}, this.blurred = true, this.$original_element = $(element), this.document = element.ownerDocument, this.window = "defaultView" in this.document ? this.document.defaultView : this.document.parentWindow, this.$document = $(this.document), this.$window = $(this.window), this.br = this.browser.msie && $.Editable.getIEversion() <= 10 ? "" : "<br/>", this.init(element), void $(element).on("editable.focus",
      $.proxy(function() {
        /** @type {number} */
        var count = 1;
        for (; count <= $.Editable.count; count++) {
          if (count != this._id) {
            this.$window.trigger("blur." + count);
          }
        }
      }, this)));
  };
  /** @type {Array} */
  self.initializers = [];
  /** @type {number} */
  self.count = 0;
  /** @type {Array} */
  self.VALID_NODES = ["P", "DIV", "LI", "TD", "TH"];
  /** @type {Array} */
  self.LANGS = [];
  /** @type {string} */
  self.INVISIBLE_SPACE = "&#x200b;";
  self.DEFAULTS = {
    allowComments: true,
    allowScript: false,
    allowStyle: false,
    allowedAttrs: ["accept", "accept-charset", "accesskey", "action", "align", "alt", "async", "autocomplete", "autofocus", "autoplay", "autosave", "background", "bgcolor", "border", "charset", "cellpadding", "cellspacing", "checked", "cite", "class", "color", "cols", "colspan", "content", "contenteditable", "contextmenu", "controls", "coords", "data", "data-.*", "datetime", "default", "defer", "dir", "dirname", "disabled", "download", "draggable", "dropzone", "enctype", "for", "form", "formaction",
      "headers", "height", "hidden", "high", "href", "hreflang", "http-equiv", "icon", "id", "ismap", "itemprop", "keytype", "kind", "label", "lang", "language", "list", "loop", "low", "max", "maxlength", "media", "method", "min", "multiple", "name", "novalidate", "open", "optimum", "pattern", "ping", "placeholder", "poster", "preload", "pubdate", "radiogroup", "readonly", "rel", "required", "reversed", "rows", "rowspan", "sandbox", "scope", "scoped", "scrolling", "seamless", "selected", "shape", "size",
      "sizes", "span", "src", "srcdoc", "srclang", "srcset", "start", "step", "summary", "spellcheck", "style", "tabindex", "target", "title", "type", "translate", "usemap", "value", "valign", "width", "wrap"
    ],
    allowedTags: ["a", "abbr", "address", "area", "article", "aside", "audio", "b", "base", "bdi", "bdo", "blockquote", "br", "button", "canvas", "caption", "cite", "code", "col", "colgroup", "datalist", "dd", "del", "details", "dfn", "dialog", "div", "dl", "dt", "em", "embed", "fieldset", "figcaption", "figure", "footer", "form", "h1", "h2", "h3", "h4", "h5", "h6", "header", "hgroup", "hr", "i", "iframe", "img", "input", "ins", "kbd", "keygen", "label", "legend", "li", "link", "main", "map", "mark",
      "menu", "menuitem", "meter", "nav", "noscript", "object", "ol", "optgroup", "option", "output", "p", "param", "pre", "progress", "queue", "rp", "rt", "ruby", "s", "samp", "script", "section", "select", "small", "source", "span", "strike", "strong", "sub", "summary", "sup", "table", "tbody", "td", "textarea", "tfoot", "th", "thead", "time", "title", "tr", "track", "u", "ul", "var", "video", "wbr"
    ],
    alwaysBlank: false,
    alwaysVisible: false,
    autosave: false,
    autosaveInterval: 1E4,
    beautifyCode: true,
    blockTags: {
      n: "Normal",
      blockquote: "Quote",
      pre: "Code",
      h1: "Heading 1",
      h2: "Heading 2",
      h3: "Heading 3",
      h4: "Heading 4",
      h5: "Heading 5",
      h6: "Heading 6"
    },
    buttons: ["bold", "italic", "underline", "strikeThrough", "fontSize", "fontFamily", "color", "sep", "formatBlock", "blockStyle", "align", "insertOrderedList", "insertUnorderedList", "outdent", "indent", "sep", "createLink", "insertImage", "insertVideo", "insertHorizontalRule", "undo", "redo", "html"],
    crossDomain: true,
    convertMailAddresses: true,
    customButtons: {},
    customDropdowns: {},
    customText: false,
    defaultTag: "P",
    direction: "ltr",
    disableRightClick: false,
    editInPopup: false,
    editorClass: "",
    formatTags: ["p", "pre", "blockquote", "h1", "h2", "h3", "h4", "h5", "h6", "div", "ul", "ol", "li", "table", "tbody", "thead", "tfoot", "tr", "th", "td", "body", "head", "html", "title", "meta", "link", "base", "script", "style"],
    headers: {},
    height: "auto",
    icons: {},
    inlineMode: true,
    initOnClick: false,
    fullPage: false,
    language: "en_us",
    linkList: [],
    linkText: false,
    linkClasses: {},
    linkAttributes: {},
    linkAutoPrefix: "",
    maxHeight: "auto",
    minHeight: "auto",
    multiLine: true,
    noFollow: true,
    paragraphy: true,
    placeholder: "Type something",
    plainPaste: false,
    preloaderSrc: "",
    saveURL: null,
    saveParam: "body",
    saveParams: {},
    saveRequestType: "POST",
    scrollableContainer: "body",
    simpleAmpersand: false,
    shortcuts: true,
    shortcutsAvailable: ["show", "bold", "italic", "underline", "createLink", "insertImage", "indent", "outdent", "html", "formatBlock n", "formatBlock h1", "formatBlock h2", "formatBlock h3", "formatBlock h4", "formatBlock h5", "formatBlock h6", "formatBlock blockquote", "formatBlock pre", "strikeThrough"],
    showNextToCursor: false,
    spellcheck: false,
    theme: null,
    toolbarFixed: true,
    trackScroll: false,
    unlinkButton: true,
    useClasses: true,
    tabSpaces: true,
    typingTimer: 500,
    pastedImagesUploadRequestType: "POST",
    pastedImagesUploadURL: "/",
    unsupportedAgents: /Opera Mini/i,
    useFrTag: false,
    width: "auto",
    withCredentials: false,
    zIndex: 2E3
  };
  /**
   * @return {undefined}
   */
  self.prototype.destroy = function() {
    this.sync();
    if (this.options.useFrTag) {
      this.addFrTag();
    }
    this.hide();
    if (this.isHTML) {
      this.html();
    }
    if (this.$bttn_wrapper) {
      this.$bttn_wrapper.html("").removeData().remove();
    }
    if (this.$editor) {
      this.$editor.html("").removeData().remove();
    }
    this.raiseEvent("destroy");
    if (this.$popup_editor) {
      this.$popup_editor.html("").removeData().remove();
    }
    if (this.$placeholder) {
      this.$placeholder.html("").removeData().remove();
    }
    clearTimeout(this.ajaxInterval);
    clearTimeout(this.typingTimer);
    this.$element.off("mousedown mouseup click keydown keyup cut copy paste focus keypress touchstart touchend touch drop");
    this.$element.off("mousedown mouseup click keydown keyup cut copy paste focus keypress touchstart touchend touch drop", "**");
    this.$window.off("mouseup." + this._id);
    this.$window.off("keydown." + this._id);
    this.$window.off("keyup." + this._id);
    this.$window.off("blur." + this._id);
    this.$window.off("hide." + this._id);
    this.$window.off("scroll." + this._id);
    this.$window.off("resize." + this._id);
    this.$window.off("orientationchange." + this._id);
    this.$document.off("selectionchange." + this._id);
    this.$original_element.off("editable");
    if (void 0 !== this.$upload_frame) {
      this.$upload_frame.remove();
    }
    if (this.$textarea) {
      this.$box.remove();
      this.$textarea.removeData("fa.editable");
      this.$textarea.show();
    }
    var k;
    for (k in this._events) {
      delete this._events[k];
    }
    if (this.$placeholder) {
      this.$placeholder.remove();
    }
    if (this.isLink) {
      this.$element.removeData("fa.editable");
    } else {
      if (this.$wrapper) {
        this.$wrapper.replaceWith(this.getHTML(false, false));
      } else {
        this.$element.replaceWith(this.getHTML(false, false));
      }
      if (this.$box) {
        if (!this.editableDisabled) {
          this.$box.removeClass("froala-box f-rtl");
          this.$box.find(".html-switch").remove();
          this.$box.removeData("fa.editable");
          clearTimeout(this.typingTimer);
        }
      }
    }
    if (this.$lb) {
      this.$lb.remove();
    }
  };
  /**
   * @param {string} name
   * @param {Array} lab
   * @param {boolean} recurring
   * @param {boolean} opt_isDefault
   * @return {?}
   */
  self.prototype.triggerEvent = function(name, lab, recurring, opt_isDefault) {
    if (void 0 === recurring) {
      /** @type {boolean} */
      recurring = true;
    }
    if (void 0 === opt_isDefault) {
      /** @type {boolean} */
      opt_isDefault = false;
    }
    if (recurring === true) {
      if (!this.isResizing()) {
        if (!this.editableDisabled) {
          if (!this.imageMode) {
            if (!!opt_isDefault) {
              this.cleanify();
            }
          }
        }
      }
      this.sync();
    }
    /** @type {boolean} */
    var value = true;
    return lab || (lab = []), value = this.$original_element.triggerHandler("editable." + name, $.merge([this], lab)), void 0 === value ? true : value;
  };
  /**
   * @return {undefined}
   */
  self.prototype.syncStyle = function() {
    if (this.options.fullPage) {
      var codeSegments = this.$element.html().match(/\[style[^\]]*\].*\[\/style\]/gi);
      if (this.$document.find("head style[data-id]").remove(), codeSegments) {
        /** @type {number} */
        var i = 0;
        for (; i < codeSegments.length; i++) {
          this.$document.find("head").append(codeSegments[i].replace(/\[/gi, "<").replace(/\]/gi, ">"));
        }
      }
    }
  };
  /**
   * @return {undefined}
   */
  self.prototype.sync = function() {
    if (!this.isHTML) {
      this.raiseEvent("sync");
      this.disableImageResize();
      if (!this.isLink) {
        if (!this.isImage) {
          this.checkPlaceholder();
        }
      }
      var currentData = this.getHTML();
      if (this.trackHTML !== currentData && null != this.trackHTML) {
        this.refreshImageList();
        this.refreshButtons();
        this.trackHTML = currentData;
        if (this.$textarea) {
          this.$textarea.val(currentData);
        }
        if (!this.doingRedo) {
          this.saveUndoStep();
        }
        this.triggerEvent("contentChanged", [], false);
      } else {
        if (null == this.trackHTML) {
          this.trackHTML = currentData;
        }
      }
      this.syncStyle();
    }
  };
  /**
   * @param {Node} elem
   * @return {?}
   */
  self.prototype.emptyElement = function(elem) {
    if ("IMG" == elem.tagName || $(elem).find("img").length > 0) {
      return false;
    }
    if ($(elem).find("input, iframe, object").length > 0) {
      return false;
    }
    var codeSegments = $(elem).text();
    /** @type {number} */
    var i = 0;
    for (; i < codeSegments.length; i++) {
      if ("\n" !== codeSegments[i] && ("\r" !== codeSegments[i] && ("\t" !== codeSegments[i] && 8203 != codeSegments[i].charCodeAt(0)))) {
        return false;
      }
    }
    return true;
  };
  /**
   * @return {undefined}
   */
  self.prototype.initEvents = function() {
    if (this.mobile()) {
      /** @type {string} */
      this.mousedown = "touchstart";
      /** @type {string} */
      this.mouseup = "touchend";
      /** @type {string} */
      this.move = "touchmove";
    } else {
      /** @type {string} */
      this.mousedown = "mousedown";
      /** @type {string} */
      this.mouseup = "mouseup";
      /** @type {string} */
      this.move = "";
    }
  };
  /**
   * @return {undefined}
   */
  self.prototype.initDisable = function() {
    this.$element.on("keypress keydown keyup", $.proxy(function(event) {
      return this.isDisabled ? (event.stopPropagation(), event.preventDefault(), false) : void 0;
    }, this));
  };
  /**
   * @return {undefined}
   */
  self.prototype.continueInit = function() {
    this.initDisable();
    this.initEvents();
    this.browserFixes();
    this.handleEnter();
    if (!this.editableDisabled) {
      this.initUndoRedo();
      this.enableTyping();
      this.initShortcuts();
    }
    this.initTabs();
    this.initEditor();
    /** @type {number} */
    var i = 0;
    for (; i < $.Editable.initializers.length; i++) {
      $.Editable.initializers[i].call(this);
    }
    this.initOptions();
    this.initEditorSelection();
    this.initAjaxSaver();
    this.setLanguage();
    this.setCustomText();
    if (!this.editableDisabled) {
      this.registerPaste();
    }
    this.refreshDisabledState();
    this.refreshUndo();
    this.refreshRedo();
    this.initPopupSubmit();
    /** @type {boolean} */
    this.initialized = true;
    this.triggerEvent("initialized", [], false, false);
  };
  /**
   * @return {undefined}
   */
  self.prototype.initPopupSubmit = function() {
    this.$popup_editor.find(".froala-popup input").keydown(function(event) {
      var key = event.which;
      if (13 == key) {
        event.preventDefault();
        event.stopPropagation();
        $(this).blur();
        $(this).parents(".froala-popup").find("button.f-submit").click();
      }
    });
  };
  /**
   * @return {undefined}
   */
  self.prototype.lateInit = function() {
    this.saveSelectionByMarkers();
    this.continueInit();
    this.restoreSelectionByMarkers();
    this.$element.focus();
    this.hideOtherEditors();
  };
  /**
   * @param {Node} element
   * @return {undefined}
   */
  self.prototype.init = function(element) {
    if (!this.options.paragraphy) {
      /** @type {string} */
      this.options.defaultTag = "DIV";
    }
    if (this.options.allowStyle) {
      this.setAllowStyle();
    }
    if (this.options.allowScript) {
      this.setAllowScript();
    }
    this.initElement(element);
    this.initElementStyle();
    if (!this.isLink || this.isImage) {
      this.initImageEvents();
      this.buildImageMove();
    }
    if (this.options.initOnClick) {
      if (!this.editableDisabled) {
        this.$element.attr("contenteditable", true);
        this.$element.attr("spellcheck", false);
      }
      this.$element.bind("mousedown.element focus.element", $.proxy(function(event) {
        return this.isLink || event.stopPropagation(), this.isDisabled ? false : (this.$element.unbind("mousedown.element focus.element"), this.browser.webkit && (this.initMouseUp = false), void this.lateInit());
      }, this));
    } else {
      this.continueInit();
    }
  };
  /**
   * @return {?}
   */
  self.prototype.phone = function() {
    /** @type {boolean} */
    var a = false;
    return function(cssText) {
      if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(cssText) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(cssText.substr(0,
          4))) {
        /** @type {boolean} */
        a = true;
      }
    }(navigator.userAgent || (navigator.vendor || window.opera)), a;
  };
  /**
   * @return {?}
   */
  self.prototype.mobile = function() {
    return this.phone() || (this.android() || (this.iOS() || this.blackberry()));
  };
  /**
   * @return {?}
   */
  self.prototype.iOS = function() {
    return /(iPad|iPhone|iPod)/g.test(navigator.userAgent);
  };
  /**
   * @return {?}
   */
  self.prototype.iOSVersion = function() {
    if (/iP(hone|od|ad)/.test(navigator.platform)) {
      /** @type {(Array.<string>|null)} */
      var octalLiteral = navigator.appVersion.match(/OS (\d+)_(\d+)_?(\d+)?/);
      /** @type {Array} */
      var units = [parseInt(octalLiteral[1], 10), parseInt(octalLiteral[2], 10), parseInt(octalLiteral[3] || 0, 10)];
      if (units && units[0]) {
        return units[0];
      }
    }
    return 0;
  };
  /**
   * @return {?}
   */
  self.prototype.iPad = function() {
    return /(iPad)/g.test(navigator.userAgent);
  };
  /**
   * @return {?}
   */
  self.prototype.iPhone = function() {
    return /(iPhone)/g.test(navigator.userAgent);
  };
  /**
   * @return {?}
   */
  self.prototype.iPod = function() {
    return /(iPod)/g.test(navigator.userAgent);
  };
  /**
   * @return {?}
   */
  self.prototype.android = function() {
    return /(Android)/g.test(navigator.userAgent);
  };
  /**
   * @return {?}
   */
  self.prototype.blackberry = function() {
    return /(Blackberry)/g.test(navigator.userAgent);
  };
  /**
   * @param {(Node|string)} clicked
   * @return {undefined}
   */
  self.prototype.initOnTextarea = function(clicked) {
    this.$textarea = $(clicked);
    if (void 0 !== this.$textarea.attr("placeholder")) {
      if ("Type something" == this.options.placeholder) {
        this.options.placeholder = this.$textarea.attr("placeholder");
      }
    }
    this.$element = $("<div>").html(this.clean(this.$textarea.val(), true, false));
    this.$element.find("pre br").replaceWith("\n");
    this.$textarea.before(this.$element).hide();
    this.$textarea.parents("form").bind("submit", $.proxy(function() {
      if (this.isHTML) {
        this.html();
      } else {
        this.sync();
      }
    }, this));
    this.addListener("destroy", $.proxy(function() {
      this.$textarea.parents("form").unbind("submit");
    }, this));
  };
  /**
   * @param {(Node|string)} element
   * @return {undefined}
   */
  self.prototype.initOnLink = function(element) {
    /** @type {boolean} */
    this.isLink = true;
    /** @type {boolean} */
    this.options.linkText = true;
    /** @type {boolean} */
    this.selectionDisabled = true;
    /** @type {boolean} */
    this.editableDisabled = true;
    /** @type {Array} */
    this.options.buttons = [];
    this.$element = $(element);
    /** @type {boolean} */
    this.options.paragraphy = false;
    /** @type {boolean} */
    this.options.countCharacters = false;
    this.$box = this.$element;
  };
  /**
   * @param {(Node|string)} el
   * @return {undefined}
   */
  self.prototype.initOnImage = function(el) {
    var value = $(el).css("float");
    if ("A" == $(el).parent().get(0).tagName) {
      el = $(el).parent();
    }
    /** @type {boolean} */
    this.isImage = true;
    /** @type {boolean} */
    this.editableDisabled = true;
    /** @type {Array} */
    this.imageList = [];
    /** @type {Array} */
    this.options.buttons = [];
    /** @type {boolean} */
    this.options.paragraphy = false;
    /** @type {string} */
    this.options.imageMargin = "auto";
    $(el).wrap("<div>");
    this.$element = $(el).parent();
    this.$element.css("display", "inline-block");
    this.$element.css("max-width", "100%");
    this.$element.css("margin-left", "auto");
    this.$element.css("margin-right", "auto");
    this.$element.css("float", value);
    this.$element.addClass("f-image");
    this.$box = $(el);
  };
  /**
   * @param {(Node|string)} element
   * @return {undefined}
   */
  self.prototype.initForPopup = function(element) {
    this.$element = $(element);
    this.$box = this.$element;
    /** @type {boolean} */
    this.editableDisabled = true;
    /** @type {boolean} */
    this.options.countCharacters = false;
    /** @type {Array} */
    this.options.buttons = [];
    this.$element.on("click", $.proxy(function(types) {
      types.preventDefault();
    }, this));
  };
  /**
   * @param {Node} element
   * @return {undefined}
   */
  self.prototype.initOnDefault = function(element) {
    if ("DIV" != element.tagName) {
      if (this.options.buttons.indexOf("formatBlock") >= 0) {
        this.disabledList.push("formatBlock");
      }
    }
    this.$element = $(element);
  };
  /**
   * @param {Node} el
   * @return {undefined}
   */
  self.prototype.initElement = function(el) {
    if ("TEXTAREA" == el.tagName ? this.initOnTextarea(el) : "A" == el.tagName ? this.initOnLink(el) : "IMG" == el.tagName ? this.initOnImage(el) : this.options.editInPopup ? this.initForPopup(el) : this.initOnDefault(el), !this.editableDisabled) {
      this.$box = this.$element.addClass("froala-box");
      this.$wrapper = $('<div class="froala-wrapper">');
      this.$element = $("<div>");
      var later = this.$box.html();
      this.$box.html(this.$wrapper.html(this.$element));
      this.$element.on("keyup", $.proxy(function() {
        if (this.$element.find("ul, ol").length > 1) {
          this.cleanupLists();
        }
      }, this));
      this.setHTML(later, true);
    }
    this.$element.on("drop", $.proxy(function() {
      setTimeout($.proxy(function() {
        $("html").click();
        this.$element.find(".f-img-wrap").each(function(dataAndEvents, step) {
          if (0 === $(step).find("img").length) {
            $(step).remove();
          }
        });
        this.$element.find(this.options.defaultTag + ":empty").remove();
      }, this), 1);
    }, this));
  };
  /**
   * @param {string} text
   * @return {?}
   */
  self.prototype.trim = function(text) {
    return text = String(text).replace(/^\s+|\s+$/g, ""), text = text.replace(/\u200B/gi, "");
  };
  /**
   * @return {undefined}
   */
  self.prototype.unwrapText = function() {
    if (!this.options.paragraphy) {
      this.$element.find(this.options.defaultTag).each($.proxy(function(dataAndEvents, element) {
        if (0 === element.attributes.length) {
          var cl = $(element).find("br:last");
          $(element).replaceWith(cl.length && this.isLastSibling(cl.get(0)) ? $(element).html() : $(element).html() + "<br/>");
        }
      }, this));
    }
  };
  /**
   * @param {Object} element
   * @param {boolean} deepDataAndEvents
   * @return {undefined}
   */
  self.prototype.wrapTextInElement = function(element, deepDataAndEvents) {
    if (void 0 === deepDataAndEvents) {
      /** @type {boolean} */
      deepDataAndEvents = false;
    }
    /** @type {Array} */
    var codeSegments = [];
    /** @type {Array} */
    var names = ["SPAN", "A", "B", "I", "EM", "U", "S", "STRONG", "STRIKE", "FONT", "IMG", "SUB", "SUP", "BUTTON", "INPUT"];
    var self = this;
    /** @type {boolean} */
    this.no_verify = true;
    /**
     * @return {?}
     */
    var render = function() {
      if (0 === codeSegments.length) {
        return false;
      }
      var table = $("<" + self.options.defaultTag + ">");
      var $field = $(codeSegments[0]);
      if (1 == codeSegments.length && "f-marker" == $field.attr("class")) {
        return void(codeSegments = []);
      }
      /** @type {number} */
      var i = 0;
      for (; i < codeSegments.length; i++) {
        var div = $(codeSegments[i]);
        table.append(div.clone());
        if (i == codeSegments.length - 1) {
          div.replaceWith(table);
        } else {
          div.remove();
        }
      }
      /** @type {Array} */
      codeSegments = [];
    };
    /** @type {boolean} */
    var waiting = false;
    /** @type {boolean} */
    var i = false;
    /** @type {boolean} */
    var destroying = false;
    element.contents().filter(function() {
      var node = $(this);
      if (node.hasClass("f-marker") || node.find(".f-marker").length) {
        var n = node;
        if (1 == node.find(".f-marker").length || node.hasClass("f-marker")) {
          n = node.find(".f-marker").length ? $(node.find(".f-marker")[0]) : node;
          var _queries = n.prev();
          if ("true" === n.attr("data-type")) {
            if (_queries.length && $(_queries[0]).hasClass("f-marker")) {
              /** @type {boolean} */
              destroying = true;
            } else {
              /** @type {boolean} */
              waiting = true;
              /** @type {boolean} */
              i = false;
            }
          } else {
            /** @type {boolean} */
            i = true;
          }
        } else {
          /** @type {boolean} */
          destroying = true;
        }
      }
      if (this.nodeType == Node.TEXT_NODE && node.text().length > 0 || names.indexOf(this.tagName) >= 0) {
        codeSegments.push(this);
      } else {
        if (this.nodeType == Node.TEXT_NODE && (0 === node.text().length && self.options.beautifyCode)) {
          node.remove();
        } else {
          if (waiting || (deepDataAndEvents || destroying)) {
            if ("BR" === this.tagName) {
              if (codeSegments.length > 0) {
                node.remove();
              } else {
                codeSegments.push(this);
              }
            }
            render();
            if (i) {
              /** @type {boolean} */
              waiting = false;
            }
            /** @type {boolean} */
            destroying = false;
          } else {
            /** @type {Array} */
            codeSegments = [];
          }
        }
      }
    });
    if (waiting || (deepDataAndEvents || destroying)) {
      render();
    }
    element.find("> " + this.options.defaultTag).each(function(dataAndEvents, b) {
      if (0 === $(b).text().trim().length) {
        if (0 === $(b).find("img").length) {
          if (0 === $(b).find("br").length) {
            $(b).append(this.br);
          }
        }
      }
    });
    element.find("div:empty:not([class])").remove();
    if (element.is(":empty")) {
      element.append(self.options.paragraphy === true ? "<" + this.options.defaultTag + ">" + this.br + "</" + this.options.defaultTag + ">" : this.br);
    }
    /** @type {boolean} */
    this.no_verify = false;
  };
  /**
   * @param {boolean} deepDataAndEvents
   * @return {?}
   */
  self.prototype.wrapText = function(deepDataAndEvents) {
    if (this.isImage || this.isLink) {
      return false;
    }
    /** @type {boolean} */
    this.allow_div = true;
    this.removeBlankSpans();
    var codeSegments = this.getSelectionElements();
    /** @type {number} */
    var i = 0;
    for (; i < codeSegments.length; i++) {
      var token = $(codeSegments[i]);
      if (["LI", "TH", "TD"].indexOf(token.get(0).tagName) >= 0) {
        this.wrapTextInElement(token, true);
      } else {
        if (this.parents(token, "li").length) {
          this.wrapTextInElement($(this.parents(token, "li")[0]), deepDataAndEvents);
        } else {
          this.wrapTextInElement(this.$element, deepDataAndEvents);
        }
      }
    }
    /** @type {boolean} */
    this.allow_div = false;
  };
  /**
   * @return {undefined}
   */
  self.prototype.convertNewLines = function() {
    this.$element.find("pre").each(function(dataAndEvents, element) {
      var $element = $(element);
      var fmt = $(element).html();
      if (fmt.indexOf("\n") >= 0) {
        $element.html(fmt.replace(/\n/g, "<br>"));
      }
    });
  };
  /**
   * @param {string} text
   * @param {boolean} recurring
   * @return {undefined}
   */
  self.prototype.setHTML = function(text, recurring) {
    /** @type {boolean} */
    this.no_verify = true;
    /** @type {boolean} */
    this.allow_div = true;
    if (void 0 === recurring) {
      /** @type {boolean} */
      recurring = true;
    }
    text = text; // this.clean(text, true, false);
    text = text.replace(/>\s+</g, "><");
    this.$element.html(text);
    this.cleanAttrs(this.$element.get(0));
    this.convertNewLines();
    /** @type {Array} */
    this.imageList = [];
    this.refreshImageList();
    if (this.options.paragraphy) {
      this.wrapText(true);
    }
    this.$element.find("li:empty").append($.Editable.INVISIBLE_SPACE);
    this.cleanupLists();
    this.cleanify(false, true, false);
    if (recurring) {
      this.restoreSelectionByMarkers();
      this.sync();
    }
    this.$element.find("span").attr("data-fr-verified", true);
    if (this.initialized) {
      this.hide();
      this.closeImageMode();
      /** @type {boolean} */
      this.imageMode = false;
    }
    /** @type {boolean} */
    this.no_verify = false;
    /** @type {boolean} */
    this.allow_div = false;
  };
  /**
   * @return {undefined}
   */
  self.prototype.beforePaste = function() {
    this.saveSelectionByMarkers();
    /** @type {null} */
    this.clipboardHTML = null;
    this.scrollPosition = this.$window.scrollTop();
    if (this.$pasteDiv) {
      this.$pasteDiv.html("");
    } else {
      this.$pasteDiv = $('<div contenteditable="true" style="position: fixed; top: 0; left: -9999px; height: 100%; width: 0; z-index: 4000; line-height: 140%;" tabindex="-1"></div>');
      this.$box.after(this.$pasteDiv);
    }
    this.$pasteDiv.focus();
    this.window.setTimeout($.proxy(this.processPaste, this), 1);
  };
  /**
   * @return {undefined}
   */
  self.prototype.processPaste = function() {
    var content = this.clipboardHTML;
    if (null === this.clipboardHTML) {
      content = this.$pasteDiv.html();
      this.restoreSelectionByMarkers();
      this.$window.scrollTop(this.scrollPosition);
    }
    var text;
    var val = this.triggerEvent("onPaste", [content], false);
    if ("string" == typeof val) {
      /** @type {string} */
      content = val;
    }
    content = content.replace(/<img /gi, '<img data-fr-image-pasted="true" ');
    if (content.match(/(class=\"?Mso|style=\"[^\"]*\bmso\-|w:WordDocument)/gi)) {
      text = this.wordClean(content);
      text = this.clean($("<div>").append(text).html(), false, true);
      text = this.removeEmptyTags(text);
    } else {
      text = content; //this.clean(content, false, true);
      text = this.removeEmptyTags(text);
      if (self.copiedText) {
        if ($("<div>").html(text).text().replace(/\u00A0/gi, " ") == self.copiedText.replace(/(\u00A0|\r|\n)/gi, " ")) {
          text = self.copiedHTML;
        }
      }
    }
    if (this.options.plainPaste) {
      text = this.plainPasteClean(text);
    }
    val = this.triggerEvent("afterPasteCleanup", [text], false);
    if ("string" == typeof val) {
      /** @type {string} */
      text = val;
    }
    if ("" !== text) {
      this.insertHTML(text, true, true);
      this.saveSelectionByMarkers();
      this.removeBlankSpans();
      this.$element.find(this.valid_nodes.join(":empty, ") + ":empty").remove();
      this.restoreSelectionByMarkers();
      this.$element.find("li[data-indent]").each($.proxy(function(dataAndEvents, element) {
        if (this.indentLi) {
          $(element).removeAttr("data-indent");
          this.indentLi($(element));
        } else {
          $(element).removeAttr("data-indent");
        }
      }, this));
      this.$element.find("li").each($.proxy(function(dataAndEvents, mediaElem) {
        this.wrapTextInElement($(mediaElem), true);
      }, this));
      if (this.options.paragraphy) {
        this.wrapText(true);
      }
      this.cleanupLists();
    }
    this.afterPaste();
  };
  /**
   * @return {undefined}
   */
  self.prototype.afterPaste = function() {
    this.uploadPastedImages();
    this.checkPlaceholder();
    /** @type {boolean} */
    this.pasting = false;
    this.triggerEvent("afterPaste", [], true, false);
  };
  /**
   * @return {?}
   */
  self.prototype.getSelectedHTML = function() {
    /**
     * @param {Element} element
     * @param {Node} node
     * @return {undefined}
     */
    function wrap(element, node) {
      for (; 3 == node.nodeType || el.valid_nodes.indexOf(node.tagName) < 0;) {
        if (3 != node.nodeType) {
          $(element).wrapInner("<" + node.tagName + el.attrs(node) + "></" + node.tagName + ">");
        }
        node = node.parentNode;
      }
    }
    var el = this;
    /** @type {string} */
    var html = "";
    if ("undefined" != typeof window.getSelection) {
      var codeSegments = this.getRanges();
      /** @type {number} */
      var i = 0;
      for (; i < codeSegments.length; i++) {
        /** @type {Element} */
        var element = document.createElement("div");
        element.appendChild(codeSegments[i].cloneContents());
        wrap(element, this.getSelectionParent());
        html += element.innerHTML;
      }
    } else {
      if ("undefined" != typeof document.selection) {
        if ("Text" == document.selection.type) {
          html = document.selection.createRange().htmlText;
        }
      }
    }
    return html;
  };
  /**
   * @return {undefined}
   */
  self.prototype.registerPaste = function() {
    this.$element.on("copy cut", $.proxy(function() {
      if (!this.isHTML) {
        self.copiedHTML = this.getSelectedHTML();
        self.copiedText = $("<div>").html(self.copiedHTML).text();
      }
    }, this));
    this.$element.on("paste", $.proxy(function(e) {
      if (!this.isHTML) {
        if (e.originalEvent && (e = e.originalEvent), !this.triggerEvent("beforePaste", [], false)) {
          return false;
        }
        if (this.clipboardPaste(e)) {
          return false;
        }
        /** @type {string} */
        this.clipboardHTML = "";
        /** @type {boolean} */
        this.pasting = true;
        this.scrollPosition = this.$window.scrollTop();
        /** @type {boolean} */
        var c = false;
        if (e && (e.clipboardData && e.clipboardData.getData)) {
          /** @type {string} */
          var requestUrl = "";
          var ca = e.clipboardData.types;
          if ($.Editable.isArray(ca)) {
            /** @type {number} */
            var i = 0;
            for (; i < ca.length; i++) {
              requestUrl += ca[i] + ";";
            }
          } else {
            requestUrl = ca;
          }
          if (/text\/html/.test(requestUrl) ? this.clipboardHTML = e.clipboardData.getData("text/html") : /text\/rtf/.test(requestUrl) && this.browser.safari ? this.clipboardHTML = e.clipboardData.getData("text/rtf") : /text\/plain/.test(requestUrl) && (!this.browser.mozilla && (this.clipboardHTML = this.escapeEntities(e.clipboardData.getData("text/plain")).replace(/\n/g, "<br/>"))), "" !== this.clipboardHTML ? c = true : this.clipboardHTML = null, c) {
            return this.processPaste(), e.preventDefault && (e.stopPropagation(), e.preventDefault()), false;
          }
        }
        this.beforePaste();
      }
    }, this));
  };
  /**
   * @param {Object} e
   * @return {?}
   */
  self.prototype.clipboardPaste = function(e) {
    if (e && (e.clipboardData && (e.clipboardData.items && e.clipboardData.items[0]))) {
      var file = e.clipboardData.items[0].getAsFile();
      if (file) {
        /** @type {FileReader} */
        var reader = new FileReader;
        return reader.onload = $.proxy(function(ev) {
          var object = ev.target.result;
          this.insertHTML('<img data-fr-image-pasted="true" src="' + object + '" />');
          this.afterPaste();
        }, this), reader.readAsDataURL(file), true;
      }
    }
    return false;
  };
  /**
   * @return {undefined}
   */
  self.prototype.uploadPastedImages = function() {
    if (this.options.pasteImage) {
      if (this.options.imageUpload) {
        this.$element.find("img[data-fr-image-pasted]").each($.proxy(function(dataAndEvents, obj) {
          if (0 === obj.src.indexOf("data:")) {
            if (this.options.defaultImageWidth && $(obj).attr("width", this.options.defaultImageWidth), this.options.pastedImagesUploadURL) {
              if (!this.triggerEvent("beforeUploadPastedImage", [obj], false)) {
                return false;
              }
              setTimeout($.proxy(function() {
                this.showImageLoader();
                this.$progress_bar.find("span").css("width", "100%").text("Please wait!");
                this.showByCoordinates($(obj).offset().left + $(obj).width() / 2, $(obj).offset().top + $(obj).height() + 10);
                /** @type {boolean} */
                this.isDisabled = true;
              }, this), 10);
              $.ajax({
                type: this.options.pastedImagesUploadRequestType,
                url: this.options.pastedImagesUploadURL,
                data: $.extend({
                  image: decodeURIComponent(obj.src)
                }, this.options.imageUploadParams),
                crossDomain: this.options.crossDomain,
                xhrFields: {
                  withCredentials: this.options.withCredentials
                },
                headers: this.options.headers,
                dataType: "json"
              }).done($.proxy(function(data) {
                try {
                  if (data.link) {
                    /** @type {Image} */
                    var image = new Image;
                    image.onerror = $.proxy(function() {
                      $(obj).remove();
                      this.hide();
                      this.throwImageError(1);
                    }, this);
                    image.onload = $.proxy(function() {
                      obj.src = data.link;
                      this.hideImageLoader();
                      this.hide();
                      this.enable();
                      setTimeout(function() {
                        $(obj).trigger("touchend");
                      }, 50);
                      this.triggerEvent("afterUploadPastedImage", [$(obj)]);
                    }, this);
                    image.src = data.link;
                  } else {
                    if (data.error) {
                      $(obj).remove();
                      this.hide();
                      this.throwImageErrorWithMessage(data.error);
                    } else {
                      $(obj).remove();
                      this.hide();
                      this.throwImageError(2);
                    }
                  }
                } catch (e) {
                  $(obj).remove();
                  this.hide();
                  this.throwImageError(4);
                }
              }, this)).fail($.proxy(function() {
                $(obj).remove();
                this.hide();
                this.throwImageError(3);
              }, this));
            }
          } else {
            if (0 !== obj.src.indexOf("http")) {
              $(obj).remove();
            }
          }
          $(obj).removeAttr("data-fr-image-pasted");
        }, this));
      }
    } else {
      this.$element.find("img[data-fr-image-pasted]").remove();
    }
  };
  /**
   * @return {undefined}
   */
  self.prototype.disable = function() {
    /** @type {boolean} */
    this.isDisabled = true;
    this.$element.blur();
    this.$box.addClass("fr-disabled");
    this.$element.attr("contenteditable", false);
  };
  /**
   * @return {undefined}
   */
  self.prototype.enable = function() {
    /** @type {boolean} */
    this.isDisabled = false;
    this.$box.removeClass("fr-disabled");
    this.$element.attr("contenteditable", true);
  };
  /**
   * @param {string} code
   * @return {?}
   */
  self.prototype.wordClean = function(code) {
    if (code.indexOf("<body") >= 0) {
      code = code.replace(/[.\s\S\w\W<>]*<body[^>]*>([.\s\S\w\W<>]*)<\/body>[.\s\S\w\W<>]*/g, "$1");
    }
    code = code.replace(/<p(.*?)class="?'?MsoListParagraph"?'? ([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<ul><li>$3</li></ul>");
    code = code.replace(/<p(.*?)class="?'?NumberedText"?'? ([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<ol><li>$3</li></ol>");
    code = code.replace(/<p(.*?)class="?'?MsoListParagraphCxSpFirst"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<ul><li$3>$5</li>");
    code = code.replace(/<p(.*?)class="?'?NumberedTextCxSpFirst"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<ol><li$3>$5</li>");
    code = code.replace(/<p(.*?)class="?'?MsoListParagraphCxSpMiddle"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<li$3>$5</li>");
    code = code.replace(/<p(.*?)class="?'?NumberedTextCxSpMiddle"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<li$3>$5</li>");
    code = code.replace(/<p(.*?)class="?'?MsoListParagraphCxSpLast"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<li$3>$5</li></ul>");
    code = code.replace(/<p(.*?)class="?'?NumberedTextCxSpLast"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<li$3>$5</li></ol>");
    code = code.replace(/<span([^<]*?)style="?'?mso-list:Ignore"?'?([\s\S]*?)>([\s\S]*?)<span/gi, "<span><span");
    code = code.replace(/\x3c!--\[if \!supportLists\]--\x3e([\s\S]*?)\x3c!--\[endif\]--\x3e/gi, "");
    code = code.replace(/<!\[if \!supportLists\]>([\s\S]*?)<!\[endif\]>/gi, "");
    code = code.replace(/(\n|\r| class=(")?Mso[a-zA-Z0-9]+(")?)/gi, " ");
    code = code.replace(/\x3c!--[\s\S]*?--\x3e/gi, "");
    code = code.replace(/<(\/)*(meta|link|span|\\?xml:|st1:|o:|font)(.*?)>/gi, "");
    /** @type {Array} */
    var badTags = ["style", "script", "applet", "embed", "noframes", "noscript"];
    /** @type {number} */
    var i = 0;
    for (; i < badTags.length; i++) {
      /** @type {RegExp} */
      var regex = new RegExp("<" + badTags[i] + ".*?" + badTags[i] + "(.*?)>", "gi");
      code = code.replace(regex, "");
    }
    code = code.replace(/&nbsp;/gi, " ");
    var lastCode;
    do {
      /** @type {string} */
      lastCode = code;
      code = code.replace(/<[^\/>][^>]*><\/[^>]+>/gi, "");
    } while (code != lastCode);
    return code = code.replace(/<lilevel([^1])([^>]*)>/gi, '<li data-indent="true"$2>'), code = code.replace(/<lilevel1([^>]*)>/gi, "<li$1>"), code = code /* this.clean(code)*/, code = code.replace(/<a>(.[^<]+)<\/a>/gi, "$1");
  };
  /**
   * @param {number} count
   * @return {?}
   */
  self.prototype.tabs = function(count) {
    /** @type {string} */
    var s = "";
    /** @type {number} */
    var baseValue = 0;
    for (; count > baseValue; baseValue++) {
      s += "  ";
    }
    return s;
  };
  /**
   * @param {string} str
   * @param {boolean} dataAndEvents
   * @return {?}
   */
  self.prototype.cleanTags = function(str, dataAndEvents) {
    if (void 0 === dataAndEvents) {
      /** @type {boolean} */
      dataAndEvents = false;
    }
    var m;
    var pos;
    var e;
    var options;
    /** @type {Array} */
    var indent = [];
    /** @type {Array} */
    var s = [];
    /** @type {boolean} */
    var value = false;
    /** @type {boolean} */
    var cap = false;
    var classes = this.options.formatTags;
    /** @type {number} */
    pos = 0;
    for (; pos < str.length; pos++) {
      if (m = str.charAt(pos), "<" == m) {
        var i = str.indexOf(">", pos + 1);
        if (-1 !== i) {
          var v = str.substring(pos, i + 1);
          var string = this.tagName(v);
          if (0 === string.indexOf("!--") && (i = str.indexOf("--\x3e", pos + 1), -1 !== i)) {
            v = str.substring(pos, i + 3);
            s.push(v);
            pos = i + 2;
            continue;
          }
          if (0 === string.indexOf("!") && (s.length && s[s.length - 1] != v)) {
            s.push(v);
            pos = i;
            continue;
          }
          if ("head" == string && (this.options.fullPage && (cap = true)), cap) {
            s.push(v);
            pos = i;
            if ("head" == string) {
              if (this.isClosingTag(v)) {
                /** @type {boolean} */
                cap = false;
              }
            }
            continue;
          }
          if (this.options.allowedTags.indexOf(string) < 0 && (!this.options.fullPage || ["html", "head", "body", "!doctype"].indexOf(string) < 0)) {
            pos = i;
            continue;
          }
          var ctrl = this.isClosingTag(v);
          if ("pre" === string && (value = ctrl ? false : true), this.isSelfClosingTag(v)) {
            s.push("br" === string && value ? "\n" : v);
          } else {
            if (ctrl) {
              /** @type {boolean} */
              e = false;
              /** @type {boolean} */
              options = true;
              for (; e === false && void 0 !== options;) {
                options = indent.pop();
                if (void 0 !== options && options.tag_name !== string) {
                  s.splice(options.i, 1);
                } else {
                  /** @type {boolean} */
                  e = true;
                  if (void 0 !== options) {
                    s.push(v);
                  }
                }
              }
            } else {
              s.push(v);
              indent.push({
                tag_name: string,
                i: s.length - 1
              });
            }
          }
          pos = i;
        }
      } else {
        if ("\n" === m && this.options.beautifyCode) {
          if (dataAndEvents && value) {
            s.push("<br/>");
          } else {
            if (value) {
              s.push(m);
            } else {
              if (indent.length > 0) {
                s.push(" ");
              }
            }
          }
        } else {
          if (9 != m.charCodeAt(0)) {
            s.push(m);
          }
        }
      }
    }
    for (; indent.length > 0;) {
      options = indent.pop();
      s.splice(options.i, 1);
    }
    /** @type {string} */
    var pre = "\n";
    if (!this.options.beautifyCode) {
      /** @type {string} */
      pre = "";
    }
    /** @type {string} */
    str = "";
    /** @type {number} */
    indent = 0;
    /** @type {boolean} */
    var q = true;
    /** @type {number} */
    pos = 0;
    for (; pos < s.length; pos++) {
      if (1 == s[pos].length) {
        if (!(q && " " === s[pos])) {
          str += s[pos];
          /** @type {boolean} */
          q = false;
        }
      } else {
        if (classes.indexOf(this.tagName(s[pos]).toLowerCase()) < 0) {
          str += s[pos];
          if ("br" == this.tagName(s[pos])) {
            str += pre;
          }
        } else {
          if (this.isSelfClosingTag(s[pos])) {
            if (classes.indexOf(this.tagName(s[pos]).toLowerCase()) >= 0) {
              str += this.tabs(indent) + s[pos] + pre;
              /** @type {boolean} */
              q = false;
            } else {
              str += s[pos];
            }
          } else {
            if (this.isClosingTag(s[pos])) {
              indent -= 1;
              if (0 === indent) {
                /** @type {boolean} */
                q = true;
              }
              if (str.length > 0) {
                if (str[str.length - 1] == pre) {
                  str += this.tabs(indent);
                }
              }
              str += s[pos] + pre;
            } else {
              str += pre + this.tabs(indent) + s[pos];
              indent += 1;
              /** @type {boolean} */
              q = false;
            }
          }
        }
      }
    }
    return str[0] == pre && (str = str.substring(1, str.length)), str[str.length - 1] == pre && (str = str.substring(0, str.length - 1)), str;
  };
  /**
   * @return {undefined}
   */
  self.prototype.cleanupLists = function() {
    this.$element.find("ul, ol").each($.proxy(function(dataAndEvents, elem) {
      var $elem = $(elem);
      if (this.parents($(elem), "ul, ol").length > 0) {
        return true;
      }
      if ($elem.find(".close-ul, .open-ul, .close-ol, .open-ol, .open-li, .close-li").length > 0) {
        /** @type {string} */
        var input = "<" + elem.tagName.toLowerCase() + ">" + $elem.html() + "</" + elem.tagName.toLowerCase() + ">";
        /** @type {string} */
        input = input.replace(new RegExp('<span class="close-ul" data-fr-verified="true"></span>', "g"), "</ul>");
        /** @type {string} */
        input = input.replace(new RegExp('<span class="open-ul" data-fr-verified="true"></span>', "g"), "<ul>");
        /** @type {string} */
        input = input.replace(new RegExp('<span class="close-ol" data-fr-verified="true"></span>', "g"), "</ol>");
        /** @type {string} */
        input = input.replace(new RegExp('<span class="open-ol" data-fr-verified="true"></span>', "g"), "<ol>");
        /** @type {string} */
        input = input.replace(new RegExp('<span class="close-li" data-fr-verified="true"></span>', "g"), "</li>");
        /** @type {string} */
        input = input.replace(new RegExp('<span class="open-li" data-fr-verified="true"></span>', "g"), "<li>");
        /** @type {string} */
        input = input.replace(new RegExp("<li></li>", "g"), "");
        $elem.replaceWith(input);
      }
    }, this));
    this.$element.find("li > td").remove();
    this.$element.find("li td:empty").append($.Editable.INVISIBLE_SPACE);
    this.$element.find(" > li").wrap("<ul>");
    this.$element.find("ul, ol").each($.proxy(function(dataAndEvents, elem) {
      var $elem = $(elem);
      if (0 === $elem.find(this.valid_nodes.join(",")).length) {
        $elem.remove();
      }
    }, this));
    this.$element.find("li > ul, li > ol").each($.proxy(function(dataAndEvents, element) {
      var header = $(element).parent().get(0).previousSibling;
      if (this.isFirstSibling(element)) {
        if (header && "LI" == header.tagName) {
          $(header).append($(element));
        } else {
          $(element).before("<br/>");
        }
      }
    }, this));
    this.$element.find("li:empty").remove();
    var codeSegments = this.$element.find("ol + ol, ul + ul");
    /** @type {number} */
    var i = 0;
    for (; i < codeSegments.length; i++) {
      var selected = $(codeSegments[i]);
      if (this.attrs(codeSegments[i]) == this.attrs(selected.prev().get(0))) {
        selected.prev().append(selected.html());
        selected.remove();
      }
    }
    this.$element.find("li > td").remove();
    this.$element.find("li td:empty").append($.Editable.INVISIBLE_SPACE);
    this.$element.find("li > " + this.options.defaultTag).each(function(dataAndEvents, element) {
      if (0 === element.attributes.length) {
        $(element).replaceWith($(element).html());
      }
    });
  };
  /**
   * @param {string} string
   * @return {?}
   */
  self.prototype.escapeEntities = function(string) {
    return string.replace(/</gi, "&lt;").replace(/>/gi, "&gt;").replace(/"/gi, "&quot;").replace(/'/gi, "&apos;");
  };
  /**
   * @param {Element} node
   * @param {Array} namespaces
   * @return {undefined}
   */
  self.prototype.cleanNodeAttrs = function(node, namespaces) {
    var attrs = node.attributes;
    if (attrs) {
      /** @type {RegExp} */
      var t = new RegExp("^" + namespaces.join("$|^") + "$", "i");
      /** @type {number} */
      var i = 0;
      for (; i < attrs.length; i++) {
        var attr = attrs[i];
        if (t.test(attr.nodeName)) {
          //node.setAttribute(attr.nodeName, attr.nodeValue.replace(/</gi, "&lt;").replace(/>/gi, "&gt;"));
        } else {
          //node.removeAttribute(attr.nodeName);
        }
      }
    }
  };
  /**
   * @param {Node} elem
   * @return {undefined}
   */
  self.prototype.cleanAttrs = function(elem) {
    if (1 == elem.nodeType) {
      if (elem.className.indexOf("f-marker") < 0) {
        if (elem !== this.$element.get(0)) {
          if ("IFRAME" != elem.tagName) {
            //this.cleanNodeAttrs(elem, this.options.allowedAttrs, true);
          }
        }
      }
    }
    var codeSegments = elem.childNodes;
    /** @type {number} */
    var i = 0;
    //for (; i < codeSegments.length; i++) {
      //this.cleanAttrs(codeSegments[i]);
    //}
  };
  /**
   * @param {string} content
   * @param {boolean} recurring
   * @param {boolean} v33
   * @param {Text} array
   * @param {Array} ids
   * @return {?}
   */
  self.prototype.clean = function(content, recurring, v33, array, ids) {
    if (this.pasting) {
      if (self.copiedText === $("<div>").html(content).text()) {
        /** @type {boolean} */
        v33 = false;
        /** @type {boolean} */
        recurring = true;
      }
    }
    if (!ids) {
      ids = $.merge([], this.options.allowedAttrs);
    }
    if (!array) {
      array = $.merge([], this.options.allowedTags);
    }
    if (!recurring) {
      if (ids.indexOf("id") > -1) {
        ids.splice(ids.indexOf("id"), 1);
      }
    }
    if (this.options.fullPage) {
      content = content.replace(/<!DOCTYPE([^>]*?)>/i, "\x3c!-- DOCTYPE$1 --\x3e");
      content = content.replace(/<html([^>]*?)>/i, "\x3c!-- html$1 --\x3e");
      content = content.replace(/<\/html([^>]*?)>/i, "\x3c!-- /html$1 --\x3e");
      content = content.replace(/<body([^>]*?)>/i, "\x3c!-- body$1 --\x3e");
      content = content.replace(/<\/body([^>]*?)>/i, "\x3c!-- /body$1 --\x3e");
      content = content.replace(/<head>([\w\W]*)<\/head>/i, function(dataAndEvents, html) {
        /** @type {number} */
        var bindIdCounter = 1;
        return html = html.replace(/(<style)/gi, function(dataAndEvents, evtName) {
          return evtName + " data-id=" + bindIdCounter++;
        }), "\x3c!-- head " + html.replace(/(>)([\s|\t]*)(<)/gi, "$1$3").replace(/</gi, "[").replace(/>/gi, "]") + " --\x3e";
      });
    }
    if (this.options.allowComments) {
      this.options.allowedTags.push("!--");
      this.options.allowedTags.push("!");
    } else {
      content = content.replace(/(\x3c!--[.\s\w\W]*?--\x3e)/gi, "");
    }
    if (!this.options.allowScript) {
      content = content.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, "");
    }
    if (!this.options.allowStyle) {
      content = content.replace(/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/gi, "");
    }
    content = content.replace(/\x3c!--([.\s\w\W]*?)--\x3e/gi, function(dataAndEvents, messageFormat) {
      return "\x3c!--" + messageFormat.replace(/</g, "[[").replace(/>/g, "]]") + "--\x3e";
    });
    /** @type {RegExp} */
    var r = new RegExp("<\\/?((?!(?:" + array.join(" |") + " |" + array.join(">|") + ">|" + array.join("/>|") + "/>))\\w+)[^>]*?>", "gi");
    if (content = content.replace(r, ""), content = content.replace(/\x3c!--([.\s\w\W]*?)--\x3e/gi, function(dataAndEvents, messageFormat) {
        return "\x3c!--" + messageFormat.replace(/\[\[/g, "<").replace(/\]\]/g, ">") + "--\x3e";
      }), v33) {
      /** @type {RegExp} */
      var urlRegex = new RegExp("style=(\"[a-zA-Z0-9:;\\.\\s\\(\\)\\-\\,!\\/'%]*\"|'[a-zA-Z0-9:;\\.\\s\\(\\)\\-\\,!\\/\"%]*')", "gi");
      content = content.replace(urlRegex, "");
      content = content.replace(/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/gi, "");
    }
    content = this.cleanTags(content, true);
    content = content.replace(/(\r|\n)/gi, "");
    /** @type {RegExp} */
    var regex = new RegExp("<([^>]*)( src| href)=('[^']*'|\"[^\"]*\"|[^\\s>]+)([^>]*)>", "gi");
    if (content = content.replace(regex, $.proxy(function(dataAndEvents, g, b, line, deepDataAndEvents) {
        return "<" + g + b + '="' + this.sanitizeURL(line.replace(/^["'](.*)["']\/?$/gi, "$1")) + '"' + deepDataAndEvents + ">";
      }, this)), !recurring) {
      var actual = $("<div>").append(content);
      actual.find('[class]:not([class^="fr-"])').each(function(dataAndEvents, element) {
        $(element).removeAttr("class");
      });
      content = actual.html();
    }
    return content;
  };
  /**
   * @return {undefined}
   */
  self.prototype.removeBlankSpans = function() {
    /** @type {boolean} */
    this.no_verify = true;
    this.$element.find("span").removeAttr("data-fr-verified");
    this.$element.find("span").each($.proxy(function(dataAndEvents, obj) {
      if (0 === this.attrs(obj).length) {
        $(obj).replaceWith($(obj).html());
      }
    }, this));
    this.$element.find("span").attr("data-fr-verified", true);
    /** @type {boolean} */
    this.no_verify = false;
  };
  /**
   * @param {string} name
   * @return {?}
   */
  self.prototype.plainPasteClean = function(name) {
    var rule = $("<div>").html(name);
    rule.find("p, div, h1, h2, h3, h4, h5, h6, pre, blockquote").each($.proxy(function(dataAndEvents, element) {
      $(element).replaceWith("<" + this.options.defaultTag + ">" + $(element).html() + "</" + this.options.defaultTag + ">");
    }, this));
    $(rule.find("*").not("p, div, h1, h2, h3, h4, h5, h6, pre, blockquote, ul, ol, li, table, tbody, thead, tr, td, br").get().reverse()).each(function() {
      $(this).replaceWith($(this).html());
    });
    /**
     * @param {string} r
     * @return {undefined}
     */
    var clean = function(r) {
      var codeSegments = r.contents();
      /** @type {number} */
      var i = 0;
      for (; i < codeSegments.length; i++) {
        if (3 != codeSegments[i].nodeType && 1 != codeSegments[i].nodeType) {
          $(codeSegments[i]).remove();
        } else {
          clean($(codeSegments[i]));
        }
      }
    };
    return clean(rule), rule.html();
  };
  /**
   * @param {string} template
   * @return {?}
   */
  self.prototype.removeEmptyTags = function(template) {
    var i;
    var preview = $("<div>").html(template);
    var codeSegments = preview.find("*:empty:not(br, img, td, th)");
    for (; codeSegments.length;) {
      /** @type {number} */
      i = 0;
      for (; i < codeSegments.length; i++) {
        $(codeSegments[i]).remove();
      }
      codeSegments = preview.find("*:empty:not(br, img, td, th)");
    }
    var resultItems = preview.find("> div, td > div, th > div, li > div");
    for (; resultItems.length;) {
      var $this = $(resultItems[resultItems.length - 1]);
      $this.replaceWith($this.html() + "<br/>");
      resultItems = preview.find("> div, td > div, th > div, li > div");
    }
    resultItems = preview.find("div");
    for (; resultItems.length;) {
      /** @type {number} */
      i = 0;
      for (; i < resultItems.length; i++) {
        var target = $(resultItems[i]);
        var elem = target.html().replace(/\u0009/gi, "").trim();
        target.replaceWith(elem);
      }
      resultItems = preview.find("div");
    }
    return preview.html();
  };
  /**
   * @return {undefined}
   */
  self.prototype.initElementStyle = function() {
    if (!this.editableDisabled) {
      this.$element.attr("contenteditable", true);
    }
    /** @type {string} */
    var placement = "froala-view froala-element " + this.options.editorClass;
    if (this.browser.msie) {
      if (self.getIEversion() < 9) {
        placement += " ie8";
      }
    }
    this.$element.css("outline", 0);
    if (!this.browser.msie) {
      placement += " not-msie";
    }
    this.$element.addClass(placement);
  };
  /**
   * @param {string} regex
   * @return {?}
   */
  self.prototype.CJKclean = function(regex) {
    /** @type {RegExp} */
    var r20 = /[\u3041-\u3096\u30A0-\u30FF\u4E00-\u9FFF\u3130-\u318F\uAC00-\uD7AF]/gi;
    return regex.replace(r20, "");
  };
  /**
   * @return {undefined}
   */
  self.prototype.enableTyping = function() {
    /** @type {null} */
    this.typingTimer = null;
    this.$element.on("keydown", "textarea, input", function(event) {
      event.stopPropagation();
    });
    this.$element.on("keydown cut", $.proxy(function(event) {
      if (!this.isHTML) {
        if (!this.options.multiLine && 13 == event.which) {
          return event.preventDefault(), event.stopPropagation(), false;
        }
        if ("keydown" === event.type && !this.triggerEvent("keydown", [event], false)) {
          return false;
        }
        clearTimeout(this.typingTimer);
        /** @type {boolean} */
        this.ajaxSave = false;
        this.oldHTML = this.getHTML(true, false);
        /** @type {number} */
        this.typingTimer = setTimeout($.proxy(function() {
          var r20 = this.getHTML(true, false);
          if (!this.ime) {
            if (!(this.CJKclean(r20) === this.CJKclean(this.oldHTML))) {
              if (!(this.CJKclean(r20) !== r20)) {
                this.sync();
              }
            }
          }
        }, this), Math.max(this.options.typingTimer, 500));
      }
    }, this));
  };
  /**
   * @param {string} html
   * @return {?}
   */
  self.prototype.removeMarkersByRegex = function(html) {
    return html.replace(/<span[^>]*? class\s*=\s*["']?f-marker["']?[^>]+>([\S\s][^\/])*<\/span>/gi, "");
  };
  /**
   * @return {?}
   */
  self.prototype.getImageHTML = function() {
    return JSON.stringify({
      src: this.$element.find("img").attr("src"),
      style: this.$element.find("img").attr("style"),
      alt: this.$element.find("img").attr("alt"),
      width: this.$element.find("img").attr("width"),
      link: this.$element.find("a").attr("href"),
      link_title: this.$element.find("a").attr("title"),
      link_target: this.$element.find("a").attr("target")
    });
  };
  /**
   * @return {?}
   */
  self.prototype.getLinkHTML = function() {
    return JSON.stringify({
      body: this.$element.html(),
      href: this.$element.attr("href"),
      title: this.$element.attr("title"),
      popout: this.$element.hasClass("popout"),
      nofollow: "nofollow" == this.$element.attr("ref"),
      blank: "_blank" == this.$element.attr("target"),
      cls: this.$element.attr("class") ? this.$element.attr("class").replace(/froala-element ?|not-msie ?|froala-view ?/gi, "").trim() : ""
    });
  };
  /**
   * @return {undefined}
   */
  self.prototype.addFrTag = function() {
    this.$element.find(this.valid_nodes.join(",") + ", table, ul, ol, img").addClass("fr-tag");
  };
  /**
   * @return {undefined}
   */
  self.prototype.removeFrTag = function() {
    this.$element.find(this.valid_nodes.join(",") + ", table, ul, ol, img").removeClass("fr-tag");
  };
  /**
   * @param {boolean} recurring
   * @param {boolean} mayParseLabeledStatementInstead
   * @param {boolean} width
   * @return {?}
   */
  self.prototype.getHTML = function(recurring, mayParseLabeledStatementInstead, width) {
    if (void 0 === recurring && (recurring = false), void 0 === mayParseLabeledStatementInstead && (mayParseLabeledStatementInstead = this.options.useFrTag), void 0 === width && (width = true), this.$element.hasClass("f-placeholder") && !recurring) {
      return "";
    }
    if (this.isHTML) {
      return this.$html_area.val();
    }
    if (this.isImage) {
      return this.getImageHTML();
    }
    if (this.isLink) {
      return this.getLinkHTML();
    }
    this.$element.find("a").data("fr-link", true);
    if (mayParseLabeledStatementInstead) {
      this.addFrTag();
    }
    this.$element.find(".f-img-editor > img").each($.proxy(function(dataAndEvents, toggle) {
      $(toggle).removeClass("fr-fin fr-fil fr-fir fr-dib fr-dii").addClass(this.getImageClass($(toggle).parent().attr("class")));
    }, this));
    if (!this.options.useClasses) {
      this.$element.find("img").each($.proxy(function(dataAndEvents, thisObject) {
        var $this = $(thisObject);
        $this.attr("data-style", this.getImageStyle($this));
      }, this));
    }
    this.$element.find("pre").each($.proxy(function(dataAndEvents, elem) {
      var q = $(elem);
      var l = q.html();
      var r = l.replace(/\&nbsp;/gi, " ").replace(/\n/gi, "<br>");
      if (l != r) {
        this.saveSelectionByMarkers();
        q.html(r);
        this.restoreSelectionByMarkers();
      }
    }, this));
    this.$element.find("pre br").addClass("fr-br");
    this.$element.find('[class=""]').removeAttr("class");
    //this.cleanAttrs(this.$element.get(0));
    var html = this.$element.html();
    this.removeFrTag();
    this.$element.find("pre br").removeAttr("class");
    html = html.replace(/<a[^>]*?><\/a>/g, "");
    if (!recurring) {
      html = this.removeMarkersByRegex(html);
    }
    html = html.replace(/<span[^>]*? class\s*=\s*["']?f-img-handle[^>]+><\/span>/gi, "");
    html = html.replace(/^([\S\s]*)<span[^>]*? class\s*=\s*["']?f-img-editor[^>]+>([\S\s]*)<\/span>([\S\s]*)$/gi, "$1$2$3");
    html = html.replace(/^([\S\s]*)<span[^>]*? class\s*=\s*["']?f-img-wrap[^>]+>([\S\s]*)<\/span>([\S\s]*)$/gi, "$1$2$3");
    if (!this.options.useClasses) {
      html = html.replace(/data-style/gi, "style");
      html = html.replace(/(<img[^>]*)( class\s*=['"]?[a-zA-Z0-9- ]+['"]?)([^>]*\/?>)/gi, "$1$3");
    }
    if (this.options.simpleAmpersand) {
      html = html.replace(/\&amp;/gi, "&");
    }
    if (width) {
      html = html.replace(/ data-fr-verified="true"/gi, "");
    }
    if (this.options.beautifyCode) {
      html = html.replace(/\n/gi, "");
    }
    html = html.replace(/<br class="fr-br">/gi, "\n");
    html = html.replace(/\u200B/gi, "");
    if (this.options.fullPage) {
      html = html.replace(/\x3c!-- DOCTYPE([^>]*?) --\x3e/i, "<!DOCTYPE$1>");
      html = html.replace(/\x3c!-- html([^>]*?) --\x3e/i, "<html$1>");
      html = html.replace(/\x3c!-- \/html([^>]*?) --\x3e/i, "</html$1>");
      html = html.replace(/\x3c!-- body([^>]*?) --\x3e/i, "<body$1>");
      html = html.replace(/\x3c!-- \/body([^>]*?) --\x3e/i, "</body$1>");
      html = html.replace(/\x3c!-- head ([\w\W]*?) --\x3e/i, function(dataAndEvents, string) {
        return "<head>" + string.replace(/\[/gi, "<").replace(/\]/gi, ">") + "</head>";
      });
    }
    var e = this.triggerEvent("getHTML", [html], false);
    return "string" == typeof e ? e : html;
  };
  /**
   * @return {?}
   */
  self.prototype.getText = function() {
    return this.$element.text();
  };
  /**
   * @param {boolean} dirty
   * @return {undefined}
   */
  self.prototype.setDirty = function(dirty) {
    /** @type {boolean} */
    this.dirty = dirty;
    if (!dirty) {
      clearTimeout(this.ajaxInterval);
      this.ajaxHTML = this.getHTML(false, false);
    }
  };
  /**
   * @return {undefined}
   */
  self.prototype.initAjaxSaver = function() {
    this.ajaxHTML = this.getHTML(false, false);
    /** @type {boolean} */
    this.ajaxSave = true;
    /** @type {number} */
    this.ajaxInterval = setInterval($.proxy(function() {
      var ajaxHTML = this.getHTML(false, false);
      if (this.ajaxHTML != ajaxHTML || this.dirty) {
        if (this.ajaxSave) {
          if (this.options.autosave) {
            this.save();
          }
          /** @type {boolean} */
          this.dirty = false;
          this.ajaxHTML = ajaxHTML;
        }
      }
      /** @type {boolean} */
      this.ajaxSave = true;
    }, this), Math.max(this.options.autosaveInterval, 100));
  };
  /**
   * @return {undefined}
   */
  self.prototype.disableBrowserUndo = function() {
    this.$element.keydown($.proxy(function(e) {
      var key = e.which;
      var c = (e.ctrlKey || e.metaKey) && !e.altKey;
      if (!this.isHTML && c) {
        if (90 == key && e.shiftKey) {
          return e.preventDefault(), false;
        }
        if (90 == key) {
          return e.preventDefault(), false;
        }
      }
    }, this));
  };
  /**
   * @param {?} existingFn
   * @return {?}
   */
  self.prototype.shortcutEnabled = function(existingFn) {
    return this.options.shortcutsAvailable.indexOf(existingFn) >= 0;
  };
  self.prototype.shortcuts_map = {
    69: {
      cmd: "show",
      params: [null],
      id: "show"
    },
    66: {
      cmd: "exec",
      params: ["bold"],
      id: "bold"
    },
    73: {
      cmd: "exec",
      params: ["italic"],
      id: "italic"
    },
    85: {
      cmd: "exec",
      params: ["underline"],
      id: "underline"
    },
    83: {
      cmd: "exec",
      params: ["strikeThrough"],
      id: "strikeThrough"
    },
    75: {
      cmd: "exec",
      params: ["createLink"],
      id: "createLink"
    },
    80: {
      cmd: "exec",
      params: ["insertImage"],
      id: "insertImage"
    },
    221: {
      cmd: "exec",
      params: ["indent"],
      id: "indent"
    },
    219: {
      cmd: "exec",
      params: ["outdent"],
      id: "outdent"
    },
    72: {
      cmd: "exec",
      params: ["html"],
      id: "html"
    },
    48: {
      cmd: "exec",
      params: ["formatBlock", "n"],
      id: "formatBlock n"
    },
    49: {
      cmd: "exec",
      params: ["formatBlock", "h1"],
      id: "formatBlock h1"
    },
    50: {
      cmd: "exec",
      params: ["formatBlock", "h2"],
      id: "formatBlock h2"
    },
    51: {
      cmd: "exec",
      params: ["formatBlock", "h3"],
      id: "formatBlock h3"
    },
    52: {
      cmd: "exec",
      params: ["formatBlock", "h4"],
      id: "formatBlock h4"
    },
    53: {
      cmd: "exec",
      params: ["formatBlock", "h5"],
      id: "formatBlock h5"
    },
    54: {
      cmd: "exec",
      params: ["formatBlock", "h6"],
      id: "formatBlock h6"
    },
    222: {
      cmd: "exec",
      params: ["formatBlock", "blockquote"],
      id: "formatBlock blockquote"
    },
    220: {
      cmd: "exec",
      params: ["formatBlock", "pre"],
      id: "formatBlock pre"
    }
  };
  /**
   * @param {Object} e
   * @return {?}
   */
  self.prototype.ctrlKey = function(e) {
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
  };
  /**
   * @return {undefined}
   */
  self.prototype.initShortcuts = function() {
    if (this.options.shortcuts) {
      this.$element.on("keydown", $.proxy(function(e) {
        var key = e.which;
        var coord = this.ctrlKey(e);
        if (!this.isHTML && coord) {
          if (this.shortcuts_map[key] && this.shortcutEnabled(this.shortcuts_map[key].id)) {
            return this.execDefaultShortcut(this.shortcuts_map[key].cmd, this.shortcuts_map[key].params);
          }
          if (90 == key && e.shiftKey) {
            return e.preventDefault(), e.stopPropagation(), this.redo(), false;
          }
          if (90 == key) {
            return e.preventDefault(), e.stopPropagation(), this.undo(), false;
          }
        }
      }, this));
    }
  };
  /**
   * @return {undefined}
   */
  self.prototype.initTabs = function() {
    this.$element.on("keydown", $.proxy(function(e) {
      var key = e.which;
      if (9 != key || e.shiftKey) {
        if (9 == key) {
          if (e.shiftKey) {
            if (this.raiseEvent("shift+tab")) {
              if (this.options.tabSpaces) {
                e.preventDefault();
              } else {
                this.blur();
              }
            } else {
              e.preventDefault();
            }
          }
        }
      } else {
        if (this.raiseEvent("tab")) {
          if (this.options.tabSpaces) {
            e.preventDefault();
            /** @type {string} */
            var statsTemplate = "&nbsp;&nbsp;&nbsp;&nbsp;";
            var node = this.getSelectionElements()[0];
            if ("PRE" === node.tagName) {
              /** @type {string} */
              statsTemplate = "    ";
            }
            this.insertHTML(statsTemplate, false);
          } else {
            this.blur();
          }
        } else {
          e.preventDefault();
        }
      }
    }, this));
  };
  /**
   * @param {?} el
   * @return {?}
   */
  self.prototype.textEmpty = function(el) {
    var searchValue = $(el).text().replace(/(\r\n|\n|\r|\t)/gm, "");
    return ("" === searchValue || el === this.$element.get(0)) && 0 === $(el).find("br").length;
  };
  /**
   * @param {string} pn
   * @return {?}
   */
  self.prototype.inEditor = function(pn) {
    for (; pn && "BODY" !== pn.tagName;) {
      if (pn === this.$element.get(0)) {
        return true;
      }
      pn = pn.parentNode;
    }
    return false;
  };
  /**
   * @param {boolean} recurring
   * @return {?}
   */
  self.prototype.focus = function(recurring) {
    if (this.isDisabled) {
      return false;
    }
    if (void 0 === recurring && (recurring = true), "" !== this.text() && !this.$element.is(":focus")) {
      return void(this.browser.msie || (this.clearSelection(), this.$element.focus()));
    }
    if (!this.isHTML) {
      if (recurring && (!this.pasting && this.$element.focus()), this.pasting && (!this.$element.is(":focus") && this.$element.focus()), this.$element.hasClass("f-placeholder")) {
        return void this.setSelection(this.$element.find(this.options.defaultTag).length > 0 ? this.$element.find(this.options.defaultTag)[0] : this.$element.get(0));
      }
      var el = this.getRange();
      if ("" === this.text() && (el && (0 === el.startOffset || (el.startContainer === this.$element.get(0) || !this.inEditor(el.startContainer))))) {
        var i;
        var val;
        var codeSegments = this.getSelectionElements();
        if ($.merge(["IMG", "BR"], this.valid_nodes).indexOf(this.getSelectionElement().tagName) < 0) {
          return false;
        }
        if (el.startOffset > 0 && (this.valid_nodes.indexOf(this.getSelectionElement().tagName) >= 0 && "BODY" != el.startContainer.tagName) || el.startContainer && 3 === el.startContainer.nodeType) {
          return;
        }
        if (!this.options.paragraphy && (codeSegments.length >= 1 && codeSegments[0] === this.$element.get(0))) {
          /**
           * @param {Node} node
           * @return {?}
           */
          var parse = function(node) {
            if (!node) {
              return null;
            }
            if (3 == node.nodeType && node.textContent.length > 0) {
              return node;
            }
            if (1 == node.nodeType && "BR" == node.tagName) {
              return node;
            }
            var codeSegments = $(node).contents();
            /** @type {number} */
            var i = 0;
            for (; i < codeSegments.length; i++) {
              var url = parse(codeSegments[i]);
              if (null != url) {
                return url;
              }
            }
            return null;
          };
          if (0 === el.startOffset && (this.$element.contents().length > 0 && 3 != this.$element.contents()[0].nodeType)) {
            var node = parse(this.$element.get(0));
            if (null != node) {
              if ("BR" == node.tagName) {
                if (this.$element.is(":focus")) {
                  $(node).before(this.markers_html);
                  this.restoreSelectionByMarkers();
                }
              } else {
                this.setSelection(node);
              }
            }
          }
          return false;
        }
        if (codeSegments.length >= 1 && codeSegments[0] !== this.$element.get(0)) {
          /** @type {number} */
          i = 0;
          for (; i < codeSegments.length; i++) {
            if (val = codeSegments[i], !this.textEmpty(val) || this.browser.msie) {
              return void this.setSelection(val);
            }
            if (this.textEmpty(val) && ["LI", "TD"].indexOf(val.tagName) >= 0) {
              return;
            }
          }
        }
        if (el.startContainer === this.$element.get(0) && (el.startOffset > 0 && !this.options.paragraphy)) {
          return void this.setSelection(this.$element.get(0), el.startOffset);
        }
        codeSegments = this.$element.find(this.valid_nodes.join(","));
        /** @type {number} */
        i = 0;
        for (; i < codeSegments.length; i++) {
          if (val = codeSegments[i], !this.textEmpty(val) && 0 === $(val).find(this.valid_nodes.join(",")).length) {
            return void this.setSelection(val);
          }
        }
        this.setSelection(this.$element.get(0));
      }
    }
  };
  /**
   * @param {Object} a
   * @return {?}
   */
  self.prototype.addMarkersAtEnd = function(a) {
    if (a.find(".fr-marker").length > 0) {
      return false;
    }
    var node = a.get(0);
    var nodes = $(node).contents();
    for (; nodes.length && this.valid_nodes.indexOf(nodes[nodes.length - 1].tagName) >= 0;) {
      node = nodes[nodes.length - 1];
      nodes = $(nodes[nodes.length - 1]).contents();
    }
    $(node).append(this.markers_html);
  };
  /**
   * @param {Object} elem
   * @return {undefined}
   */
  self.prototype.setFocusAtEnd = function(elem) {
    if (void 0 === elem) {
      elem = this.$element;
    }
    this.addMarkersAtEnd(elem);
    this.restoreSelectionByMarkers();
  };
  /**
   * @param {string} str
   * @param {boolean} e
   * @return {?}
   */
  self.prototype.breakHTML = function(str, e) {
    if ("undefined" == typeof e) {
      /** @type {boolean} */
      e = true;
    }
    this.removeMarkers();
    if (0 === this.$element.find("break").length) {
      this.insertSimpleHTML("<break></break>");
    }
    var obj = this.parents(this.$element.find("break"), $.merge(["UL", "OL"], this.valid_nodes).join(","))[0];
    if (this.parents($(obj), "ul, ol").length && (obj = this.parents($(obj), "ul, ol")[0]), void 0 === obj && (obj = this.$element.get(0)), ["UL", "OL"].indexOf(obj.tagName) >= 0) {
      var match = $("<div>").html(str);
      match.find("> li").wrap("<" + obj.tagName + ">");
      str = match.html();
    }
    if (obj == this.$element.get(0)) {
      if (this.$element.find("break").next().length) {
        this.insertSimpleHTML('<div id="inserted-div">' + str + "</div>");
        var self = this.$element.find("div#inserted-div");
        this.setFocusAtEnd(self);
        this.saveSelectionByMarkers();
        self.replaceWith(self.contents());
        this.restoreSelectionByMarkers();
      } else {
        this.insertSimpleHTML(str);
        this.setFocusAtEnd();
      }
      return this.$element.find("break").remove(), this.checkPlaceholder(), true;
    }
    if ("TD" === obj.tagName) {
      return this.$element.find("break").remove(), this.insertSimpleHTML(str), true;
    }
    var results = $("<div>").html(str);
    if (this.addMarkersAtEnd(results), str = results.html(), this.emptyElement($(obj))) {
      return $(obj).replaceWith(str), this.restoreSelectionByMarkers(), this.checkPlaceholder(), true;
    }
    this.$element.find("li").each($.proxy(function(dataAndEvents, elem) {
      if (this.emptyElement(elem)) {
        $(elem).addClass("empty-li");
      }
    }, this));
    var environment;
    var line;
    var fileContents = $("<div></div>").append($(obj).clone()).html();
    /** @type {Array} */
    var xs = [];
    var points = {};
    /** @type {Array} */
    var ret = [];
    /** @type {number} */
    var n = 0;
    /** @type {number} */
    var startIndex = 0;
    for (; startIndex < fileContents.length; startIndex++) {
      if (line = fileContents.charAt(startIndex), "<" == line) {
        var endIndex = fileContents.indexOf(">", startIndex + 1);
        if (-1 !== endIndex) {
          environment = fileContents.substring(startIndex, endIndex + 1);
          var a = this.tagName(environment);
          if (startIndex = endIndex, "break" == a) {
            if (!this.isClosingTag(environment)) {
              /** @type {boolean} */
              var r = true;
              /** @type {Array} */
              var res = [];
              /** @type {number} */
              var j = xs.length - 1;
              for (; j >= 0; j--) {
                var letter = this.tagName(xs[j]);
                if (!e && "LI" == letter.toUpperCase()) {
                  /** @type {boolean} */
                  r = false;
                  break;
                }
                ret.push("</" + letter + ">");
                res.push(xs[j]);
              }
              ret.push(str);
              if (!r) {
                ret.push("</li><li>");
              }
              /** @type {number} */
              var i = 0;
              for (; i < res.length; i++) {
                ret.push(res[i]);
              }
            }
          } else {
            if (ret.push(environment), !this.isSelfClosingTag(environment)) {
              if (this.isClosingTag(environment)) {
                var ix = points[a].pop();
                xs.splice(ix, 1);
              } else {
                xs.push(environment);
                if (void 0 === points[a]) {
                  /** @type {Array} */
                  points[a] = [];
                }
                points[a].push(xs.length - 1);
              }
            }
          }
        }
      } else {
        n++;
        ret.push(line);
      }
    }
    $(obj).replaceWith(ret.join(""));
    this.$element.find("li").each($.proxy(function(dataAndEvents, elem) {
      var $elem = $(elem);
      if ($elem.hasClass("empty-li")) {
        $elem.removeClass("empty-li");
      } else {
        if (this.emptyElement(elem)) {
          $elem.remove();
        }
      }
    }, this));
    this.cleanupLists();
    this.restoreSelectionByMarkers();
  };
  /**
   * @param {string} html
   * @return {undefined}
   */
  self.prototype.insertSimpleHTML = function(html) {
    var sel;
    var range;
    if (this.no_verify = true, this.window.getSelection) {
      if (sel = this.window.getSelection(), sel.getRangeAt && sel.rangeCount) {
        range = sel.getRangeAt(0);
        if (this.browser.webkit) {
          if (!range.collapsed) {
            this.document.execCommand("delete");
          }
        } else {
          range.deleteContents();
        }
        this.$element.find(this.valid_nodes.join(":empty, ") + ":empty").remove();
        var tempNode = this.document.createElement("div");
        /** @type {string} */
        tempNode.innerHTML = html;
        var nodeToInsert;
        var previousElementSibling;
        var newNode = this.document.createDocumentFragment();
        for (; nodeToInsert = tempNode.firstChild;) {
          previousElementSibling = newNode.appendChild(nodeToInsert);
        }
        range.insertNode(newNode);
        if (previousElementSibling) {
          range = range.cloneRange();
          range.setStartAfter(previousElementSibling);
          range.collapse(true);
          sel.removeAllRanges();
          sel.addRange(range);
        }
      }
    } else {
      if ((sel = this.document.selection) && "Control" != sel.type) {
        var range3 = sel.createRange();
        range3.collapse(true);
        sel.createRange().pasteHTML(html);
      }
    }
    /** @type {boolean} */
    this.no_verify = false;
  };
  /**
   * @param {string} html
   * @param {boolean} recurring
   * @param {boolean} dataAndEvents
   * @return {?}
   */
  self.prototype.insertHTML = function(html, recurring, dataAndEvents) {
    if (void 0 === recurring && (recurring = true), void 0 === dataAndEvents && (dataAndEvents = false), !this.isHTML && (recurring && this.focus()), this.removeMarkers(), this.insertSimpleHTML("<break></break>"), this.checkPlaceholder(true), this.$element.hasClass("f-placeholder")) {
      return this.$element.html(html), this.options.paragraphy && this.wrapText(true), this.$element.find("p > br").each(function() {
        var node = this.parentNode;
        if (1 == $(node).contents().length) {
          $(node).remove();
        }
      }), this.$element.find("break").remove(), this.setFocusAtEnd(), this.checkPlaceholder(), this.convertNewLines(), false;
    }
    var codeSegments = $("<div>").append(html).find("*");
    /** @type {number} */
    var i = 0;
    for (; i < codeSegments.length; i++) {
      if (this.valid_nodes.indexOf(codeSegments[i].tagName) >= 0) {
        return this.breakHTML(html), this.$element.find("break").remove(), this.convertNewLines(), false;
      }
    }
    this.$element.find("break").remove();
    this.insertSimpleHTML(html);
    this.convertNewLines();
  };
  /**
   * @param {?} syncFnName
   * @param {?} checkSet
   * @return {?}
   */
  self.prototype.execDefaultShortcut = function(syncFnName, checkSet) {
    return this[syncFnName].apply(this, checkSet), false;
  };
  /**
   * @return {undefined}
   */
  self.prototype.initEditor = function() {
    /** @type {string} */
    var froala_editor = "froala-editor";
    if (this.mobile()) {
      froala_editor += " touch";
    }
    if (this.browser.msie) {
      if (self.getIEversion() < 9) {
        froala_editor += " ie8";
      }
    }
    this.$editor = $('<div class="' + froala_editor + '" style="display: none;">');
    var stringBuffer = this.$document.find(this.options.scrollableContainer);
    stringBuffer.append(this.$editor);
    if (this.options.inlineMode) {
      this.initInlineEditor();
    } else {
      this.initBasicEditor();
    }
  };
  /**
   * @return {undefined}
   */
  self.prototype.refreshToolbarPosition = function() {
    if (this.$window.scrollTop() > this.$box.offset().top && this.$window.scrollTop() < this.$box.offset().top + this.$box.outerHeight() - this.$editor.outerHeight()) {
      this.$element.css("padding-top", this.$editor.outerHeight() + this.$element.data("padding-top"));
      this.$placeholder.css("margin-top", this.$editor.outerHeight() + this.$element.data("padding-top"));
      this.$editor.addClass("f-scroll").removeClass("f-scroll-abs").css("bottom", "").css("left", this.$box.offset().left + parseFloat(this.$box.css("padding-left"), 10) - this.$window.scrollLeft()).width(this.$box.width() - parseFloat(this.$editor.css("border-left-width"), 10) - parseFloat(this.$editor.css("border-right-width"), 10));
      if (this.iOS()) {
        if (this.$element.is(":focus")) {
          this.$editor.css("top", this.$window.scrollTop());
        } else {
          this.$editor.css("top", "");
        }
      }
    } else {
      if (this.$window.scrollTop() < this.$box.offset().top) {
        if (this.iOS() && this.$element.is(":focus")) {
          this.$element.css("padding-top", this.$editor.outerHeight() + this.$element.data("padding-top"));
          this.$placeholder.css("margin-top", this.$editor.outerHeight() + this.$element.data("padding-top"));
          this.$editor.addClass("f-scroll").removeClass("f-scroll-abs").css("bottom", "").css("left", this.$box.offset().left + parseFloat(this.$box.css("padding-left"), 10) - this.$window.scrollLeft()).width(this.$box.width() - parseFloat(this.$editor.css("border-left-width"), 10) - parseFloat(this.$editor.css("border-right-width"), 10));
          this.$editor.css("top", this.$box.offset().top);
        } else {
          this.$editor.removeClass("f-scroll f-scroll-abs").css("bottom", "").css("top", "").width("");
          this.$element.css("padding-top", "");
          this.$placeholder.css("margin-top", "");
        }
      } else {
        if (this.$window.scrollTop() > this.$box.offset().top + this.$box.outerHeight() - this.$editor.outerHeight() && !this.$editor.hasClass("f-scroll-abs")) {
          this.$element.css("padding-top", this.$editor.outerHeight() + this.$element.data("padding-top"));
          this.$placeholder.css("margin-top", this.$editor.outerHeight() + this.$element.data("padding-top"));
          this.$editor.removeClass("f-scroll").addClass("f-scroll-abs");
          this.$editor.css("bottom", 0).css("top", "").css("left", "");
        } else {
          this.$editor.removeClass("f-scroll").css("bottom", "").css("top", "").css("left", "").width("");
        }
      }
    }
  };
  /**
   * @return {undefined}
   */
  self.prototype.toolbarTop = function() {
    if (!this.options.toolbarFixed) {
      if (!this.options.inlineMode) {
        this.$element.data("padding-top", parseInt(this.$element.css("padding-top"), 10));
        this.$window.on("scroll resize load", $.proxy(function() {
          this.refreshToolbarPosition();
        }, this));
        if (this.iOS()) {
          this.$element.on("focus blur", $.proxy(function() {
            this.refreshToolbarPosition();
          }, this));
        }
      }
    }
  };
  /**
   * @return {undefined}
   */
  self.prototype.initBasicEditor = function() {
    this.$element.addClass("f-basic");
    this.$wrapper.addClass("f-basic");
    this.$popup_editor = this.$editor.clone();
    var tr = this.$document.find(this.options.scrollableContainer);
    this.$popup_editor.appendTo(tr).addClass("f-inline");
    this.$editor.addClass("f-basic").show();
    this.$editor.insertBefore(this.$wrapper);
    this.toolbarTop();
  };
  /**
   * @return {undefined}
   */
  self.prototype.initInlineEditor = function() {
    this.$editor.addClass("f-inline");
    this.$element.addClass("f-inline");
    this.$popup_editor = this.$editor;
  };
  /**
   * @return {undefined}
   */
  self.prototype.initDrag = function() {
    this.drag_support = {
      filereader: "undefined" != typeof FileReader,
      formdata: !!this.window.FormData,
      progress: "upload" in new XMLHttpRequest
    };
  };
  /**
   * @return {undefined}
   */
  self.prototype.initOptions = function() {
    this.setDimensions();
    this.setSpellcheck();
    this.setImageUploadURL();
    this.setButtons();
    this.setDirection();
    this.setZIndex();
    this.setTheme();
    if (this.options.editInPopup) {
      this.buildEditPopup();
    }
    if (!this.editableDisabled) {
      this.setPlaceholder();
      this.setPlaceholderEvents();
    }
  };
  /**
   * @param {?} index
   * @return {undefined}
   */
  self.prototype.setAllowStyle = function(index) {
    if ("undefined" == typeof index) {
      index = this.options.allowStyle;
    }
    if (index) {
      this.options.allowedTags.push("style");
    } else {
      this.options.allowedTags.splice(this.options.allowedTags.indexOf("style"), 1);
    }
  };
  /**
   * @param {?} index
   * @return {undefined}
   */
  self.prototype.setAllowScript = function(index) {
    if ("undefined" == typeof index) {
      index = this.options.allowScript;
    }
    if (index) {
      this.options.allowedTags.push("script");
    } else {
      this.options.allowedTags.splice(this.options.allowedTags.indexOf("script"), 1);
    }
  };
  /**
   * @return {?}
   */
  self.prototype.isTouch = function() {
    return WYSIWYGModernizr.touch && void 0 !== this.window.Touch;
  };
  /**
   * @return {undefined}
   */
  self.prototype.initEditorSelection = function() {
    this.$element.on("keyup", $.proxy(function(mouseInfo) {
      return this.triggerEvent("keyup", [mouseInfo], false);
    }, this));
    this.$element.on("focus", $.proxy(function() {
      if (this.blurred) {
        /** @type {boolean} */
        this.blurred = false;
        if (!this.pasting) {
          if (!("" !== this.text())) {
            this.focus(false);
          }
        }
        this.triggerEvent("focus", [], false);
      }
    }, this));
    this.$element.on("mousedown touchstart", $.proxy(function() {
      return this.isDisabled ? false : void(this.isResizing() || (this.closeImageMode(), this.hide()));
    }, this));
    if (this.options.disableRightClick) {
      this.$element.contextmenu($.proxy(function(types) {
        return types.preventDefault(), this.options.inlineMode && this.$element.focus(), false;
      }, this));
    }
    this.$element.on(this.mouseup, $.proxy(function(event) {
      if (this.isDisabled) {
        return false;
      }
      if (!this.isResizing()) {
        var text = this.text();
        event.stopPropagation();
        /** @type {boolean} */
        this.imageMode = false;
        if (!("" !== text || (this.options.alwaysVisible || (this.options.editInPopup || (3 == event.which || 2 == event.button) && (this.options.inlineMode && (!this.isImage && this.options.disableRightClick))))) || (this.link || this.imageMode)) {
          if (!this.options.inlineMode) {
            this.refreshButtons();
          }
        } else {
          setTimeout($.proxy(function() {
            text = this.text();
            if (!!("" !== text || (this.options.alwaysVisible || (this.options.editInPopup || (3 == event.which || 2 == event.button) && (this.options.inlineMode && (!this.isImage && this.options.disableRightClick)))))) {
              if (!this.link) {
                if (!this.imageMode) {
                  this.show(event);
                  if (this.options.editInPopup) {
                    this.showEditPopup();
                  }
                }
              }
            }
          }, this), 0);
        }
      }
      this.hideDropdowns();
      this.hideOtherEditors();
    }, this));
    this.$editor.on(this.mouseup, $.proxy(function(event) {
      return this.isDisabled ? false : void(this.isResizing() || (event.stopPropagation(), this.options.inlineMode === false && this.hide()));
    }, this));
    this.$editor.on("mousedown", ".fr-dropdown-menu", $.proxy(function(event) {
      return this.isDisabled ? false : (event.stopPropagation(), void(this.noHide = true));
    }, this));
    this.$popup_editor.on("mousedown", ".fr-dropdown-menu", $.proxy(function(event) {
      return this.isDisabled ? false : (event.stopPropagation(), void(this.noHide = true));
    }, this));
    this.$popup_editor.on("mouseup", $.proxy(function(event) {
      return this.isDisabled ? false : void(this.isResizing() || event.stopPropagation());
    }, this));
    if (this.$edit_popup_wrapper) {
      this.$edit_popup_wrapper.on("mouseup", $.proxy(function(event) {
        return this.isDisabled ? false : void(this.isResizing() || event.stopPropagation());
      }, this));
    }
    this.setDocumentSelectionChangeEvent();
    this.setWindowMouseUpEvent();
    this.setWindowKeyDownEvent();
    this.setWindowKeyUpEvent();
    this.setWindowOrientationChangeEvent();
    this.setWindowHideEvent();
    this.setWindowBlurEvent();
    if (this.options.trackScroll) {
      this.setWindowScrollEvent();
    }
    this.setWindowResize();
  };
  /**
   * @return {undefined}
   */
  self.prototype.setWindowResize = function() {
    this.$window.on("resize." + this._id, $.proxy(function() {
      this.hide();
      this.closeImageMode();
      /** @type {boolean} */
      this.imageMode = false;
    }, this));
  };
  /**
   * @param {boolean} dataAndEvents
   * @return {undefined}
   */
  self.prototype.blur = function(dataAndEvents) {
    if (!this.blurred) {
      if (!this.pasting) {
        /** @type {boolean} */
        this.selectionDisabled = true;
        this.triggerEvent("blur", []);
        if (dataAndEvents) {
          if (0 === $("*:focus").length) {
            this.clearSelection();
          }
        }
        if (!this.isLink) {
          if (!this.isImage) {
            /** @type {boolean} */
            this.selectionDisabled = false;
          }
        }
        /** @type {boolean} */
        this.blurred = true;
      }
    }
  };
  /**
   * @return {undefined}
   */
  self.prototype.setWindowBlurEvent = function() {
    this.$window.on("blur." + this._id, $.proxy(function(deepDataAndEvents, dataAndEvents) {
      this.blur(dataAndEvents);
    }, this));
  };
  /**
   * @return {undefined}
   */
  self.prototype.setWindowHideEvent = function() {
    this.$window.on("hide." + this._id, $.proxy(function() {
      if (this.isResizing()) {
        this.$element.find(".f-img-handle").trigger("moveend");
      } else {
        this.hide(false);
      }
    }, this));
  };
  /**
   * @return {undefined}
   */
  self.prototype.setWindowOrientationChangeEvent = function() {
    this.$window.on("orientationchange." + this._id, $.proxy(function() {
      setTimeout($.proxy(function() {
        this.hide();
      }, this), 10);
    }, this));
  };
  /**
   * @return {undefined}
   */
  self.prototype.setDocumentSelectionChangeEvent = function() {
    this.$document.on("selectionchange." + this._id, $.proxy(function(event) {
      return this.isDisabled ? false : void(this.isResizing() || (this.isScrolling || (clearTimeout(this.selectionChangedTimeout), this.selectionChangedTimeout = setTimeout($.proxy(function() {
        if (this.options.inlineMode && (this.selectionInEditor() && (this.link !== true && this.isTouch()))) {
          var text = this.text();
          if ("" !== text) {
            if (this.iPod()) {
              if (this.options.alwaysVisible) {
                this.hide();
              }
            } else {
              this.show(null);
            }
            event.stopPropagation();
          } else {
            if (this.options.alwaysVisible) {
              this.show(null);
            } else {
              this.hide();
              this.closeImageMode();
              /** @type {boolean} */
              this.imageMode = false;
            }
          }
        }
      }, this), 75))));
    }, this));
  };
  /**
   * @return {undefined}
   */
  self.prototype.setWindowMouseUpEvent = function() {
    this.$window.on(this.mouseup + "." + this._id, $.proxy(function() {
      return this.browser.webkit && !this.initMouseUp ? (this.initMouseUp = true, false) : (this.isResizing() || (this.isScrolling || (this.isDisabled || (this.$bttn_wrapper.find("button.fr-trigger").removeClass("active"), this.selectionInEditor() && ("" !== this.text() && !this.isTouch()) ? this.show(null) : this.$popup_editor.is(":visible") && (this.hide(), this.closeImageMode(), this.imageMode = false), this.blur(true)))), void $("[data-down]").removeAttr("data-down"));
    }, this));
  };
  /**
   * @return {undefined}
   */
  self.prototype.setWindowKeyDownEvent = function() {
    this.$window.on("keydown." + this._id, $.proxy(function(event) {
      var key = event.which;
      if (27 == key && (this.focus(), this.restoreSelection(), this.hide(), this.closeImageMode(), this.imageMode = false), this.imageMode) {
        if (13 == key) {
          return this.$element.find(".f-img-editor").parents(".f-img-wrap").before("<br/>"), this.sync(), this.$element.find(".f-img-editor img").click(), false;
        }
        if (46 == key || 8 == key) {
          return event.stopPropagation(), event.preventDefault(), setTimeout($.proxy(function() {
            this.removeImage(this.$element.find(".f-img-editor img"));
          }, this), 0), false;
        }
      } else {
        if (this.selectionInEditor()) {
          if (this.isDisabled) {
            return true;
          }
          var d = (event.ctrlKey || event.metaKey) && !event.altKey;
          if (!d) {
            if (this.$popup_editor.is(":visible")) {
              if (this.$bttn_wrapper.is(":visible")) {
                if (this.options.inlineMode) {
                  this.hide();
                  this.closeImageMode();
                  /** @type {boolean} */
                  this.imageMode = false;
                }
              }
            }
          }
        }
      }
    }, this));
  };
  /**
   * @return {undefined}
   */
  self.prototype.setWindowKeyUpEvent = function() {
    this.$window.on("keyup." + this._id, $.proxy(function() {
      return this.isDisabled ? false : void(this.selectionInEditor() && ("" !== this.text() && (!this.$popup_editor.is(":visible") && this.repositionEditor())));
    }, this));
  };
  /**
   * @return {undefined}
   */
  self.prototype.setWindowScrollEvent = function() {
    $.merge(this.$window, $(this.options.scrollableContainer)).on("scroll." + this._id, $.proxy(function() {
      return this.isDisabled ? false : (clearTimeout(this.scrollTimer), this.isScrolling = true, void(this.scrollTimer = setTimeout($.proxy(function() {
        /** @type {boolean} */
        this.isScrolling = false;
      }, this), 2500)));
    }, this));
  };
  /**
   * @param {string} text
   * @return {undefined}
   */
  self.prototype.setPlaceholder = function(text) {
    if (text) {
      /** @type {string} */
      this.options.placeholder = text;
    }
    if (this.$textarea) {
      this.$textarea.attr("placeholder", this.options.placeholder);
    }
    if (!this.$placeholder) {
      this.$placeholder = $('<span class="fr-placeholder" unselectable="on"></span>').bind("click", $.proxy(function() {
        this.focus();
      }, this));
      this.$element.after(this.$placeholder);
    }
    this.$placeholder.text(this.options.placeholder);
  };
  /**
   * @return {?}
   */
  self.prototype.isEmpty = function() {
    var searchValue = this.$element.text().replace(/(\r\n|\n|\r|\t|\u200B|\u0020)/gm, "");
    return "" === searchValue && (0 === this.$element.find("img, table, iframe, input, textarea, hr, li, object").length && (0 === this.$element.find(this.options.defaultTag + " > br, br").length && 0 === this.$element.find($.map(this.valid_nodes, $.proxy(function(dataAndEvents) {
      return this.options.defaultTag == dataAndEvents ? null : dataAndEvents;
    }, this)).join(", ")).length));
  };
  /**
   * @param {boolean} dataAndEvents
   * @return {?}
   */
  self.prototype.checkPlaceholder = function(dataAndEvents) {
    if (this.isDisabled && !dataAndEvents) {
      return false;
    }
    if (this.pasting && !dataAndEvents) {
      return false;
    }
    if (this.$element.find("td:empty, th:empty").append($.Editable.INVISIBLE_SPACE), this.$element.find(this.valid_nodes.join(":empty, ") + ":empty").append(this.br), !this.isHTML) {
      if (this.isEmpty() && !this.fakeEmpty()) {
        var text;
        var e = this.selectionInEditor() || this.$element.is(":focus");
        if (this.options.paragraphy) {
          text = $("<" + this.options.defaultTag + ">" + this.br + "</" + this.options.defaultTag + ">");
          this.$element.html(text);
          if (e) {
            this.setSelection(text.get(0));
          }
          this.$element.addClass("f-placeholder");
        } else {
          if (!(0 !== this.$element.find("br").length)) {
            if (!(this.browser.msie && self.getIEversion() <= 10)) {
              this.$element.append(this.br);
              if (e) {
                if (this.browser.msie) {
                  this.focus();
                }
              }
            }
          }
          this.$element.addClass("f-placeholder");
        }
      } else {
        if (!this.$element.find(this.options.defaultTag + ", li, td, th").length && this.options.paragraphy) {
          this.wrapText(true);
          if (this.$element.find(this.options.defaultTag).length && "" === this.text()) {
            this.setSelection(this.$element.find(this.options.defaultTag)[0], this.$element.find(this.options.defaultTag).text().length, null, this.$element.find(this.options.defaultTag).text().length);
          } else {
            this.$element.removeClass("f-placeholder");
          }
        } else {
          if (this.fakeEmpty() === false && (!this.options.paragraphy || this.$element.find(this.valid_nodes.join(",")).length >= 1)) {
            this.$element.removeClass("f-placeholder");
          } else {
            if (!this.options.paragraphy && this.$element.find(this.valid_nodes.join(",")).length >= 1) {
              this.$element.removeClass("f-placeholder");
            } else {
              this.$element.addClass("f-placeholder");
            }
          }
        }
      }
    }
    return true;
  };
  /**
   * @param {Object} elem
   * @return {?}
   */
  self.prototype.fakeEmpty = function(elem) {
    if (void 0 === elem) {
      elem = this.$element;
    }
    /** @type {boolean} */
    var tail = true;
    if (this.options.paragraphy) {
      /** @type {boolean} */
      tail = 1 == elem.find(this.options.defaultTag).length ? true : false;
    }
    var searchValue = elem.text().replace(/(\r\n|\n|\r|\t|\u200B)/gm, "");
    return "" === searchValue && (tail && (1 == elem.find("br, li").length && 0 === elem.find("img, table, iframe, input, textarea, hr, li").length));
  };
  /**
   * @return {undefined}
   */
  self.prototype.setPlaceholderEvents = function() {
    if (!(this.browser.msie && self.getIEversion() < 9)) {
      this.$element.on("focus click", $.proxy(function(statement) {
        return this.isDisabled ? false : void("" !== this.$element.text() || (this.pasting || (this.$element.data("focused") || "click" !== statement.type ? "focus" == statement.type && this.focus(false) : this.$element.focus(), this.$element.data("focused", true))));
      }, this));
      this.$element.on("keyup keydown input focus placeholderCheck", $.proxy(function() {
        return this.checkPlaceholder();
      }, this));
      this.$element.trigger("placeholderCheck");
    }
  };
  /**
   * @param {number} height
   * @param {number} width
   * @param {number} h
   * @param {number} y
   * @return {undefined}
   */
  self.prototype.setDimensions = function(height, width, h, y) {
    if (height) {
      /** @type {number} */
      this.options.height = height;
    }
    if (width) {
      /** @type {number} */
      this.options.width = width;
    }
    if (h) {
      /** @type {number} */
      this.options.minHeight = h;
    }
    if (y) {
      /** @type {number} */
      this.options.maxHeight = y;
    }
    if ("auto" != this.options.height) {
      this.$wrapper.css("height", this.options.height);
      this.$element.css("minHeight", this.options.height - parseInt(this.$element.css("padding-top"), 10) - parseInt(this.$element.css("padding-bottom"), 10));
    }
    if ("auto" != this.options.minHeight) {
      this.$wrapper.css("minHeight", this.options.minHeight);
      this.$element.css("minHeight", this.options.minHeight);
    }
    if ("auto" != this.options.maxHeight) {
      this.$wrapper.css("maxHeight", this.options.maxHeight);
    }
    if ("auto" != this.options.width) {
      this.$box.css("width", this.options.width);
    }
  };
  /**
   * @param {(number|string)} direction
   * @return {undefined}
   */
  self.prototype.setDirection = function(direction) {
    if (direction) {
      /** @type {(number|string)} */
      this.options.direction = direction;
    }
    if ("ltr" != this.options.direction) {
      if ("rtl" != this.options.direction) {
        /** @type {string} */
        this.options.direction = "ltr";
      }
    }
    if ("rtl" == this.options.direction) {
      this.$element.removeAttr("dir");
      this.$box.addClass("f-rtl");
      this.$element.addClass("f-rtl");
      this.$editor.addClass("f-rtl");
      this.$popup_editor.addClass("f-rtl");
      if (this.$image_modal) {
        this.$image_modal.addClass("f-rtl");
      }
    } else {
      this.$element.attr("dir", "auto");
      this.$box.removeClass("f-rtl");
      this.$element.removeClass("f-rtl");
      this.$editor.removeClass("f-rtl");
      this.$popup_editor.removeClass("f-rtl");
      if (this.$image_modal) {
        this.$image_modal.removeClass("f-rtl");
      }
    }
  };
  /**
   * @param {number} zIndex
   * @return {undefined}
   */
  self.prototype.setZIndex = function(zIndex) {
    if (zIndex) {
      /** @type {number} */
      this.options.zIndex = zIndex;
    }
    this.$editor.css("z-index", this.options.zIndex);
    this.$popup_editor.css("z-index", this.options.zIndex + 1);
    if (this.$overlay) {
      this.$overlay.css("z-index", this.options.zIndex + 1002);
    }
    if (this.$image_modal) {
      this.$image_modal.css("z-index", this.options.zIndex + 1003);
    }
  };
  /**
   * @param {string} theme
   * @return {undefined}
   */
  self.prototype.setTheme = function(theme) {
    if (theme) {
      /** @type {string} */
      this.options.theme = theme;
    }
    if (null != this.options.theme) {
      this.$editor.addClass(this.options.theme + "-theme");
      this.$popup_editor.addClass(this.options.theme + "-theme");
      if (this.$box) {
        this.$box.addClass(this.options.theme + "-theme");
      }
      if (this.$image_modal) {
        this.$image_modal.addClass(this.options.theme + "-theme");
      }
    }
  };
  /**
   * @param {?} on
   * @return {undefined}
   */
  self.prototype.setSpellcheck = function(on) {
    if (void 0 !== on) {
      this.options.spellcheck = on;
    }
    this.$element.attr("spellcheck", this.options.spellcheck);
  };
  /**
   * @param {Object} map
   * @return {undefined}
   */
  self.prototype.customizeText = function(map) {
    if (map) {
      var scripts = this.$editor.find("[title]").add(this.$popup_editor.find("[title]"));
      if (this.$image_modal) {
        scripts = scripts.add(this.$image_modal.find("[title]"));
      }
      scripts.each($.proxy(function(dataAndEvents, ctx) {
        var letter;
        for (letter in map) {
          if ($(ctx).attr("title").toLowerCase() == letter.toLowerCase()) {
            $(ctx).attr("title", map[letter]);
          }
        }
      }, this));
      scripts = this.$editor.find('[data-text="true"]').add(this.$popup_editor.find('[data-text="true"]'));
      if (this.$image_modal) {
        scripts = scripts.add(this.$image_modal.find('[data-text="true"]'));
      }
      scripts.each($.proxy(function(dataAndEvents, _cell) {
        var letter;
        for (letter in map) {
          if ($(_cell).text().toLowerCase() == letter.toLowerCase()) {
            $(_cell).text(map[letter]);
          }
        }
      }, this));
    }
  };
  /**
   * @param {string} value
   * @return {undefined}
   */
  self.prototype.setLanguage = function(value) {
    if (void 0 !== value) {
      /** @type {string} */
      this.options.language = value;
    }
    if ($.Editable.LANGS[this.options.language]) {
      this.customizeText($.Editable.LANGS[this.options.language].translation);
      if ($.Editable.LANGS[this.options.language].direction) {
        if ($.Editable.LANGS[this.options.language].direction != $.Editable.DEFAULTS.direction) {
          this.setDirection($.Editable.LANGS[this.options.language].direction);
        }
      }
      if ($.Editable.LANGS[this.options.language].translation[this.options.placeholder]) {
        this.setPlaceholder($.Editable.LANGS[this.options.language].translation[this.options.placeholder]);
      }
    }
  };
  /**
   * @param {?} array
   * @return {undefined}
   */
  self.prototype.setCustomText = function(array) {
    if (array) {
      this.options.customText = array;
    }
    if (this.options.customText) {
      this.customizeText(this.options.customText);
    }
  };
  /**
   * @return {undefined}
   */
  self.prototype.execHTML = function() {
    this.html();
  };
  /**
   * @return {undefined}
   */
  self.prototype.initHTMLArea = function() {
    this.$html_area = $('<textarea wrap="hard">').keydown(function(event) {
      var c = event.keyCode || event.which;
      if (9 == c) {
        event.preventDefault();
        var selectionStart = $(this).get(0).selectionStart;
        var endPos = $(this).get(0).selectionEnd;
        $(this).val($(this).val().substring(0, selectionStart) + "\t" + $(this).val().substring(endPos));
        $(this).get(0).selectionStart = $(this).get(0).selectionEnd = selectionStart + 1;
      }
    }).focus($.proxy(function() {
      if (this.blurred) {
        /** @type {boolean} */
        this.blurred = false;
        this.triggerEvent("focus", [], false);
      }
    }, this)).mouseup($.proxy(function() {
      if (this.blurred) {
        /** @type {boolean} */
        this.blurred = false;
        this.triggerEvent("focus", [], false);
      }
    }, this));
  };
  self.prototype.command_dispatcher = {
    /**
     * @param {Object} a
     * @return {?}
     */
    align: function(a) {
      var b = this.buildDropdownAlign(a);
      var num = this.buildDropdownButton(a, b);
      return num;
    },
    /**
     * @param {Object} tag
     * @return {?}
     */
    formatBlock: function(tag) {
      var results = this.buildDropdownFormatBlock(tag);
      var elements = this.buildDropdownButton(tag, results);
      return elements;
    },
    /**
     * @param {string} template
     * @return {?}
     */
    html: function(template) {
      var html = this.buildDefaultButton(template);
      return this.options.inlineMode && this.$box.append($(html).clone(true).addClass("html-switch").attr("title", "Hide HTML").click($.proxy(this.execHTML, this))), this.initHTMLArea(), html;
    }
  };
  /**
   * @param {Array} options
   * @return {undefined}
   */
  self.prototype.setButtons = function(options) {
    if (options) {
      /** @type {Array} */
      this.options.buttons = options;
    }
    this.$editor.append('<div class="bttn-wrapper" id="bttn-wrapper-' + this._id + '">');
    this.$bttn_wrapper = this.$editor.find("#bttn-wrapper-" + this._id);
    if (this.mobile()) {
      this.$bttn_wrapper.addClass("touch");
    }
    var ref;
    var data;
    /** @type {string} */
    var output = "";
    /** @type {number} */
    var k = 0;
    for (; k < this.options.buttons.length; k++) {
      var key = this.options.buttons[k];
      if ("sep" != key) {
        var o = self.commands[key];
        if (void 0 !== o) {
          o.cmd = key;
          var matcherFunction = this.command_dispatcher[o.cmd];
          if (matcherFunction) {
            output += matcherFunction.apply(this, [o]);
          } else {
            if (o.seed) {
              ref = this.buildDefaultDropdown(o);
              data = this.buildDropdownButton(o, ref);
              output += data;
            } else {
              data = this.buildDefaultButton(o);
              output += data;
              this.bindRefreshListener(o);
            }
          }
        } else {
          if (o = this.options.customButtons[key], void 0 === o) {
            if (o = this.options.customDropdowns[key], void 0 === o) {
              continue;
            }
            data = this.buildCustomDropdown(o, key);
            output += data;
            this.bindRefreshListener(o);
            continue;
          }
          data = this.buildCustomButton(o, key);
          output += data;
          this.bindRefreshListener(o);
        }
      } else {
        output += this.options.inlineMode ? '<div class="f-clear"></div><hr/>' : '<span class="f-sep"></span>';
      }
    }
    this.$bttn_wrapper.html(output);
    this.$bttn_wrapper.find('button[data-cmd="undo"], button[data-cmd="redo"]').prop("disabled", true);
    this.bindButtonEvents();
  };
  /**
   * @param {Object} o
   * @return {undefined}
   */
  self.prototype.bindRefreshListener = function(o) {
    if (o.refresh) {
      this.addListener("refresh", $.proxy(function() {
        o.refresh.apply(this, [o.cmd]);
      }, this));
    }
  };
  /**
   * @param {Object} options
   * @return {?}
   */
  self.prototype.buildDefaultButton = function(options) {
    /** @type {string} */
    var b = '<button tabIndex="-1" type="button" class="fr-bttn" title="' + options.title + '" data-cmd="' + options.cmd + '">';
    return b += void 0 === this.options.icons[options.cmd] ? this.addButtonIcon(options) : this.prepareIcon(this.options.icons[options.cmd], options.title), b += "</button>";
  };
  /**
   * @param {Element} props
   * @param {string} newTitle
   * @return {?}
   */
  self.prototype.prepareIcon = function(props, newTitle) {
    switch (props.type) {
      case "font":
        return this.addButtonIcon({
          icon: props.value
        });
      case "img":
        return this.addButtonIcon({
          icon_img: props.value,
          title: newTitle
        });
      case "txt":
        return this.addButtonIcon({
          icon_txt: props.value
        });
    }
  };
  /**
   * @param {Object} obj
   * @return {?}
   */
  self.prototype.addButtonIcon = function(obj) {
    return obj.icon ? '<i class="' + obj.icon + '"></i>' : obj.icon_alt ? '<i class="for-text">' + obj.icon_alt + "</i>" : obj.icon_img ? '<img src="' + obj.icon_img + '" alt="' + obj.title + '"/>' : obj.icon_txt ? "<i>" + obj.icon_txt + "</i>" : obj.title;
  };
  /**
   * @param {Object} o
   * @param {string} keepData
   * @return {?}
   */
  self.prototype.buildCustomButton = function(o, keepData) {
    this["call_" + keepData] = o.callback;
    /** @type {string} */
    var buildCustomButton = '<button tabIndex="-1" type="button" class="fr-bttn" data-callback="call_' + keepData + '" data-cmd="button_name" data-name="' + keepData + '" title="' + o.title + '">' + this.prepareIcon(o.icon, o.title) + "</button>";
    return buildCustomButton;
  };
  /**
   * @param {string} dataAndEvents
   * @param {Function} matcherFunction
   * @return {undefined}
   */
  self.prototype.callDropdown = function(dataAndEvents, matcherFunction) {
    this.$bttn_wrapper.on("click touch", '[data-name="' + dataAndEvents + '"]', $.proxy(function(event) {
      event.preventDefault();
      event.stopPropagation();
      matcherFunction.apply(this);
    }, this));
  };
  /**
   * @param {Element} parent
   * @param {string} s
   * @return {?}
   */
  self.prototype.buildCustomDropdown = function(parent, s) {
    /** @type {string} */
    var d = '<div class="fr-bttn fr-dropdown">';
    d += '<button tabIndex="-1" type="button" class="fr-trigger" title="' + parent.title + '" data-name="' + s + '">' + this.prepareIcon(parent.icon, parent.title) + "</button>";
    d += '<ul class="fr-dropdown-menu">';
    /** @type {number} */
    var inner = 0;
    var k;
    for (k in parent.options) {
      this["call_" + s + inner] = parent.options[k];
      /** @type {string} */
      var chunk = '<li data-callback="call_' + s + inner + '" data-cmd="' + s + inner + '" data-name="' + s + inner + '"><a href="#">' + k + "</a></li>";
      d += chunk;
      inner++;
    }
    return d += "</ul></div>";
  };
  /**
   * @param {Object} options
   * @param {string} obj
   * @param {string} classNames
   * @return {?}
   */
  self.prototype.buildDropdownButton = function(options, obj, classNames) {
    classNames = classNames || "";
    /** @type {string} */
    var str = '<div class="fr-bttn fr-dropdown ' + classNames + '">';
    /** @type {string} */
    var optsData = "";
    optsData += void 0 === this.options.icons[options.cmd] ? this.addButtonIcon(options) : this.prepareIcon(this.options.icons[options.cmd], options.title);
    /** @type {string} */
    var vcards = '<button tabIndex="-1" type="button" data-name="' + options.cmd + '" class="fr-trigger" title="' + options.title + '">' + optsData + "</button>";
    return str += vcards, str += obj, str += "</div>";
  };
  /**
   * @param {Object} result
   * @return {?}
   */
  self.prototype.buildDropdownAlign = function(result) {
    this.bindRefreshListener(result);
    /** @type {string} */
    var b = '<ul class="fr-dropdown-menu f-align">';
    /** @type {number} */
    var i = 0;
    for (; i < result.seed.length; i++) {
      var entry = result.seed[i];
      b += '<li data-cmd="align" data-val="' + entry.cmd + '" title="' + entry.title + '"><a href="#"><i class="' + entry.icon + '"></i></a></li>';
    }
    return b += "</ul>";
  };
  /**
   * @param {Object} options
   * @return {?}
   */
  self.prototype.buildDropdownFormatBlock = function(options) {
    /** @type {string} */
    var d = '<ul class="fr-dropdown-menu">';
    var xx;
    for (xx in this.options.blockTags) {
      /** @type {string} */
      var chunk = '<li data-cmd="' + options.cmd + '" data-val="' + xx + '">';
      chunk += '<a href="#" data-text="true" class="format-' + xx + '" title="' + this.options.blockTags[xx] + '">' + this.options.blockTags[xx] + "</a></li>";
      d += chunk;
    }
    return d += "</ul>";
  };
  /**
   * @param {Object} o
   * @return {?}
   */
  self.prototype.buildDefaultDropdown = function(o) {
    /** @type {string} */
    var d = '<ul class="fr-dropdown-menu">';
    /** @type {number} */
    var i = 0;
    for (; i < o.seed.length; i++) {
      var cmd = o.seed[i];
      /** @type {string} */
      var chunk = '<li data-namespace="' + o.namespace + '" data-cmd="' + (cmd.cmd || o.cmd) + '" data-val="' + cmd.value + '" data-param="' + (cmd.param || o.param) + '">';
      chunk += '<a href="#" data-text="true" class="' + cmd.value + '" title="' + cmd.title + '">' + cmd.title + "</a></li>";
      d += chunk;
    }
    return d += "</ul>";
  };
  /**
   * @return {?}
   */
  self.prototype.createEditPopupHTML = function() {
    /** @type {string} */
    var a = '<div class="froala-popup froala-text-popup" style="display:none;">';
    return a += '<h4><span data-text="true">Edit text</span><i title="Cancel" class="fa fa-times" id="f-text-close-' + this._id + '"></i></h4></h4>', a += '<div class="f-popup-line"><input type="text" placeholder="http://www.example.com" class="f-lu" id="f-ti-' + this._id + '">', a += '<button data-text="true" type="button" class="f-ok" id="f-edit-popup-ok-' + this._id + '">OK</button>', a += "</div>", a += "</div>";
  };
  /**
   * @return {undefined}
   */
  self.prototype.buildEditPopup = function() {
    this.$edit_popup_wrapper = $(this.createEditPopupHTML());
    this.$popup_editor.append(this.$edit_popup_wrapper);
    this.$edit_popup_wrapper.find("#f-ti-" + this._id).on("mouseup keydown", function(event) {
      event.stopPropagation();
    });
    this.addListener("hidePopups", $.proxy(function() {
      this.$edit_popup_wrapper.hide();
    }, this));
    this.$edit_popup_wrapper.on("click", "#f-edit-popup-ok-" + this._id, $.proxy(function() {
      this.$element.text(this.$edit_popup_wrapper.find("#f-ti-" + this._id).val());
      this.sync();
      this.hide();
    }, this));
    this.$edit_popup_wrapper.on("click", "i#f-text-close-" + this._id, $.proxy(function() {
      this.hide();
    }, this));
  };
  /**
   * @param {string} method
   * @param {?} url
   * @return {?}
   */
  self.prototype.createCORSRequest = function(method, url) {
    /** @type {XMLHttpRequest} */
    var xhr = new XMLHttpRequest;
    if ("withCredentials" in xhr) {
      xhr.open(method, url, true);
      if (this.options.withCredentials) {
        /** @type {boolean} */
        xhr.withCredentials = true;
      }
      var k;
      for (k in this.options.headers) {
        xhr.setRequestHeader(k, this.options.headers[k]);
      }
    } else {
      if ("undefined" != typeof XDomainRequest) {
        /** @type {XDomainRequest} */
        xhr = new XDomainRequest;
        xhr.open(method, url);
      } else {
        /** @type {null} */
        xhr = null;
      }
    }
    return xhr;
  };
  /**
   * @param {string} cmd
   * @return {?}
   */
  self.prototype.isEnabled = function(cmd) {
    return $.inArray(cmd, this.options.buttons) >= 0;
  };
  /**
   * @return {undefined}
   */
  self.prototype.bindButtonEvents = function() {
    this.bindDropdownEvents(this.$bttn_wrapper);
    this.bindCommandEvents(this.$bttn_wrapper);
  };
  /**
   * @param {Object} $document
   * @return {undefined}
   */
  self.prototype.bindDropdownEvents = function($document) {
    var that = this;
    $document.on(this.mousedown, ".fr-dropdown .fr-trigger:not([disabled])", function(e) {
      return "mousedown" === e.type && 1 !== e.which ? true : ("LI" === this.tagName && ("touchstart" === e.type && that.android()) || (that.iOS() || e.preventDefault()), void $(this).attr("data-down", true));
    });
    $document.on(this.mouseup, ".fr-dropdown .fr-trigger:not([disabled])", function(event) {
      if (that.isDisabled) {
        return false;
      }
      if (event.stopPropagation(), event.preventDefault(), !$(this).attr("data-down")) {
        return $("[data-down]").removeAttr("data-down"), false;
      }
      $("[data-down]").removeAttr("data-down");
      if (that.options.inlineMode === false) {
        if (0 === $(this).parents(".froala-popup").length) {
          that.hide();
          that.closeImageMode();
          /** @type {boolean} */
          that.imageMode = false;
        }
      }
      $(this).toggleClass("active").trigger("blur");
      var callback;
      var name = $(this).attr("data-name");
      return self.commands[name] ? callback = self.commands[name].refreshOnShow : that.options.customDropdowns[name] ? callback = that.options.customDropdowns[name].refreshOnShow : self.image_commands[name] && (callback = self.image_commands[name].refreshOnShow), callback && callback.call(that), $document.find("button.fr-trigger").not(this).removeClass("active"), false;
    });
    $document.on(this.mouseup, ".fr-dropdown", function(event) {
      event.stopPropagation();
      event.preventDefault();
    });
    this.$element.on("mouseup", "img, a", $.proxy(function() {
      return this.isDisabled ? false : void $document.find(".fr-dropdown .fr-trigger").removeClass("active");
    }, this));
    $document.on("click", "li[data-cmd] > a", function(types) {
      types.preventDefault();
    });
  };
  /**
   * @param {Object} srv
   * @return {undefined}
   */
  self.prototype.bindCommandEvents = function(srv) {
    var o = this;
    srv.on(this.mousedown, "button[data-cmd], li[data-cmd], span[data-cmd], a[data-cmd]", function(e) {
      return "mousedown" === e.type && 1 !== e.which ? true : ("LI" === this.tagName && ("touchstart" === e.type && o.android()) || (o.iOS() || e.preventDefault()), void $(this).attr("data-down", true));
    });
    srv.on(this.mouseup + " " + this.move, "button[data-cmd], li[data-cmd], span[data-cmd], a[data-cmd]", $.proxy(function(e) {
      if (o.isDisabled) {
        return false;
      }
      if ("mouseup" === e.type && 1 !== e.which) {
        return true;
      }
      var el = e.currentTarget;
      if ("touchmove" != e.type) {
        if (e.stopPropagation(), e.preventDefault(), !$(el).attr("data-down")) {
          return $("[data-down]").removeAttr("data-down"), false;
        }
        if ($("[data-down]").removeAttr("data-down"), $(el).data("dragging") || $(el).attr("disabled")) {
          return $(el).removeData("dragging"), false;
        }
        var sleep = $(el).data("timeout");
        if (sleep) {
          clearTimeout(sleep);
          $(el).removeData("timeout");
        }
        var oride = $(el).attr("data-callback");
        if (o.options.inlineMode === false && (0 === $(el).parents(".froala-popup").length && (o.hide(), o.closeImageMode(), o.imageMode = false)), oride) {
          $(el).parents(".fr-dropdown").find(".fr-trigger.active").removeClass("active");
          o[oride]();
        } else {
          var fn = $(el).attr("data-namespace");
          var s = $(el).attr("data-cmd");
          var restoreScript = $(el).attr("data-val");
          var typePattern = $(el).attr("data-param");
          if (fn) {
            o["exec" + fn](s, restoreScript, typePattern);
          } else {
            o.exec(s, restoreScript, typePattern);
            o.$bttn_wrapper.find(".fr-dropdown .fr-trigger").removeClass("active");
          }
        }
        return false;
      }
      if (!$(el).data("timeout")) {
        $(el).data("timeout", setTimeout(function() {
          $(el).data("dragging", true);
        }, 200));
      }
    }, this));
  };
  /**
   * @return {?}
   */
  self.prototype.save = function() {
    if (!this.triggerEvent("beforeSave", [], false)) {
      return false;
    }
    if (this.options.saveURL) {
      var settings = {};
      var i;
      for (i in this.options.saveParams) {
        var arg = this.options.saveParams[i];
        settings[i] = "function" == typeof arg ? arg.call(this) : arg;
      }
      var data = {};
      data[this.options.saveParam] = this.getHTML();
      $.ajax({
        type: this.options.saveRequestType,
        url: this.options.saveURL,
        data: $.extend(data, settings),
        crossDomain: this.options.crossDomain,
        xhrFields: {
          withCredentials: this.options.withCredentials
        },
        headers: this.options.headers
      }).done($.proxy(function(mouseInfo) {
        this.triggerEvent("afterSave", [mouseInfo]);
      }, this)).fail($.proxy(function() {
        this.triggerEvent("saveError", ["Save request failed on the server."]);
      }, this));
    } else {
      this.triggerEvent("saveError", ["Missing save URL."]);
    }
  };
  /**
   * @param {string} str
   * @return {?}
   */
  self.prototype.isURL = function(str) {
    if (!/^(https?:|ftps?:|)\/\//.test(str)) {
      return false;
    }
    /** @type {string} */
    str = String(str).replace(/</g, "%3C").replace(/>/g, "%3E").replace(/"/g, "%22").replace(/ /g, "%20");
    /** @type {RegExp} */
    var hChars = /\(?(?:(https?:|ftps?:|)\/\/)?(?:((?:[^\W\s]|\.|-|[:]{1})+)@{1})?((?:www.)?(?:[^\W\s]|\.|-)+[\.][^\W\s]{2,4}|(?:www.)?(?:[^\W\s]|\.|-)|localhost|\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(?::(\d*))?([\/]?[^\s\?]*[\/]{1})*(?:\/?([^\s\n\?\[\]\{\}\#]*(?:(?=\.)){1}|[^\s\n\?\[\]\{\}\.\#]*)?([\.]{1}[^\s\?\#]*)?)?(?:\?{1}([^\s\n\#\[\]]*))?([\#][^\s\n]*)?\)?/gi;
    return hChars.test(str);
  };
  /**
   * @param {string} text
   * @return {?}
   */
  self.prototype.sanitizeURL = function(text) {
    if (/^(https?:|ftps?:|)\/\//.test(text)) {
      if (!this.isURL(text)) {
        return "";
      }
    } else {
      /** @type {string} */
      text = encodeURIComponent(text).replace(/%23/g, "#").replace(/%2F/g, "/").replace(/%25/g, "%").replace(/mailto%3A/g, "mailto:").replace(/tel%3A/g, "tel:").replace(/data%3Aimage/g, "data:image").replace(/webkit-fake-url%3A/g, "webkit-fake-url:").replace(/%3F/g, "?").replace(/%3D/g, "=").replace(/%26/g, "&").replace(/&amp;/g, "&").replace(/%2C/g, ",").replace(/%3B/g, ";").replace(/%2B/g, "+").replace(/%40/g, "@");
    }
    return text;
  };
  /**
   * @param {string} element
   * @param {string} child
   * @return {?}
   */
  self.prototype.parents = function(element, child) {
    return element.get(0) != this.$element.get(0) ? element.parentsUntil(this.$element, child) : [];
  };
  /**
   * @param {number} key
   * @param {string} value
   * @return {?}
   */
  self.prototype.option = function(key, value) {
    if (void 0 === key) {
      return this.options;
    }
    if (key instanceof Object) {
      this.options = $.extend({}, this.options, key);
      this.initOptions();
      this.setCustomText();
      this.setLanguage();
      this.setAllowScript();
      this.setAllowStyle();
    } else {
      if (void 0 === value) {
        return this.options[key];
      }
      switch (this.options[key] = value, key) {
        case "direction":
          this.setDirection();
          break;
        case "height":
          ;
        case "width":
          ;
        case "minHeight":
          ;
        case "maxHeight":
          this.setDimensions();
          break;
        case "spellcheck":
          this.setSpellcheck();
          break;
        case "placeholder":
          this.setPlaceholder();
          break;
        case "customText":
          this.setCustomText();
          break;
        case "language":
          this.setLanguage();
          break;
        case "textNearImage":
          this.setTextNearImage();
          break;
        case "zIndex":
          this.setZIndex();
          break;
        case "theme":
          this.setTheme();
          break;
        case "allowScript":
          this.setAllowScript();
          break;
        case "allowStyle":
          this.setAllowStyle();
      }
    }
  };
  var editable = $.fn.editable;
  /**
   * @param {Object} opts
   * @return {?}
   */
  $.fn.editable = function(opts) {
    /** @type {Array} */
    var args = [];
    /** @type {number} */
    var i = 0;
    for (; i < arguments.length; i++) {
      args.push(arguments[i]);
    }
    if ("string" == typeof opts) {
      /** @type {Array} */
      var out = [];
      return this.each(function() {
        var $spy = $(this);
        var shuffle = $spy.data("fa.editable");
        if (!shuffle[opts]) {
          return $.error("Method " + opts + " does not exist in Froala Editor.");
        }
        var copies = shuffle[opts].apply(shuffle, args.slice(1));
        if (void 0 === copies) {
          out.push(this);
        } else {
          if (0 === out.length) {
            out.push(copies);
          }
        }
      }), 1 == out.length ? out[0] : out;
    }
    return "object" != typeof opts && opts ? void 0 : this.each(function() {
      var el = this;
      var $this = $(el);
      var data = $this.data("fa.editable");
      if (!data) {
        $this.data("fa.editable", data = new self(el, opts));
      }
    });
  };
  /** @type {function (Node, boolean): ?} */
  $.fn.editable.Constructor = self;
  /** @type {function (Node, boolean): ?} */
  $.Editable = self;
  /**
   * @return {?}
   */
  $.fn.editable.noConflict = function() {
    return $.fn.editable = editable, this;
  };
}(window.jQuery),
function(obj) {
  /**
   * @return {undefined}
   */
  obj.Editable.prototype.initUndoRedo = function() {
    /** @type {Array} */
    this.undoStack = [];
    /** @type {number} */
    this.undoIndex = 0;
    this.saveUndoStep();
    this.disableBrowserUndo();
  };
  /**
   * @return {undefined}
   */
  obj.Editable.prototype.undo = function() {
    if (this.no_verify = true, this.undoIndex > 1) {
      clearTimeout(this.typingTimer);
      this.triggerEvent("beforeUndo", [], false);
      var pdataCur = this.undoStack[--this.undoIndex - 1];
      this.restoreSnapshot(pdataCur);
      /** @type {boolean} */
      this.doingRedo = true;
      this.triggerEvent("afterUndo", []);
      /** @type {boolean} */
      this.doingRedo = false;
      if ("" !== this.text()) {
        this.repositionEditor();
      } else {
        this.hide();
      }
      this.$element.trigger("placeholderCheck");
      this.focus();
      this.refreshButtons();
    }
    /** @type {boolean} */
    this.no_verify = false;
  };
  /**
   * @return {undefined}
   */
  obj.Editable.prototype.redo = function() {
    if (this.no_verify = true, this.undoIndex < this.undoStack.length) {
      clearTimeout(this.typingTimer);
      this.triggerEvent("beforeRedo", [], false);
      var pdataCur = this.undoStack[this.undoIndex++];
      this.restoreSnapshot(pdataCur);
      /** @type {boolean} */
      this.doingRedo = true;
      this.triggerEvent("afterRedo", []);
      /** @type {boolean} */
      this.doingRedo = false;
      if ("" !== this.text()) {
        this.repositionEditor();
      } else {
        this.hide();
      }
      this.$element.trigger("placeholderCheck");
      this.focus();
      this.refreshButtons();
    }
    /** @type {boolean} */
    this.no_verify = false;
  };
  /**
   * @return {?}
   */
  obj.Editable.prototype.saveUndoStep = function() {
    if (!this.undoStack) {
      return false;
    }
    for (; this.undoStack.length > this.undoIndex;) {
      this.undoStack.pop();
    }
    var datum = this.getSnapshot();
    if (!(this.undoStack[this.undoIndex - 1] && this.identicSnapshots(this.undoStack[this.undoIndex - 1], datum))) {
      this.undoStack.push(datum);
      this.undoIndex++;
    }
    this.refreshUndo();
    this.refreshRedo();
  };
  /**
   * @return {undefined}
   */
  obj.Editable.prototype.refreshUndo = function() {
    if (this.isEnabled("undo")) {
      if (void 0 === this.$editor) {
        return;
      }
      this.$bttn_wrapper.find('[data-cmd="undo"]').removeAttr("disabled");
      if (0 === this.undoStack.length || (this.undoIndex <= 1 || this.isHTML)) {
        this.$bttn_wrapper.find('[data-cmd="undo"]').attr("disabled", true);
      }
    }
  };
  /**
   * @return {undefined}
   */
  obj.Editable.prototype.refreshRedo = function() {
    if (this.isEnabled("redo")) {
      if (void 0 === this.$editor) {
        return;
      }
      this.$bttn_wrapper.find('[data-cmd="redo"]').removeAttr("disabled");
      if (this.undoIndex == this.undoStack.length || this.isHTML) {
        this.$bttn_wrapper.find('[data-cmd="redo"]').prop("disabled", true);
      }
    }
  };
  /**
   * @param {Node} node
   * @return {?}
   */
  obj.Editable.prototype.getNodeIndex = function(node) {
    var nodes = node.parentNode.childNodes;
    /** @type {number} */
    var ret = 0;
    /** @type {null} */
    var child = null;
    /** @type {number} */
    var i = 0;
    for (; i < nodes.length; i++) {
      if (child) {
        /** @type {boolean} */
        var f = 3 === nodes[i].nodeType && "" === nodes[i].textContent;
        /** @type {boolean} */
        var g = 3 === child.nodeType && 3 === nodes[i].nodeType;
        if (!f) {
          if (!g) {
            ret++;
          }
        }
      }
      if (nodes[i] == node) {
        return ret;
      }
      child = nodes[i];
    }
  };
  /**
   * @param {Node} cur
   * @return {?}
   */
  obj.Editable.prototype.getNodeLocation = function(cur) {
    /** @type {Array} */
    var matched = [];
    if (!cur.parentNode) {
      return [];
    }
    for (; cur != this.$element.get(0);) {
      matched.push(this.getNodeIndex(cur));
      cur = cur.parentNode;
    }
    return matched.reverse();
  };
  /**
   * @param {Array} codeSegments
   * @return {?}
   */
  obj.Editable.prototype.getNodeByLocation = function(codeSegments) {
    var tmp = this.$element.get(0);
    /** @type {number} */
    var i = 0;
    for (; i < codeSegments.length; i++) {
      tmp = tmp.childNodes[codeSegments[i]];
    }
    return tmp;
  };
  /**
   * @param {boolean} node
   * @param {?} writes
   * @return {?}
   */
  obj.Editable.prototype.getRealNodeOffset = function(node, writes) {
    for (; node && 3 === node.nodeType;) {
      var n = node.previousSibling;
      if (n) {
        if (3 == n.nodeType) {
          writes += n.textContent.length;
        }
      }
      node = n;
    }
    return writes;
  };
  /**
   * @param {Object} dirtyRange
   * @return {?}
   */
  obj.Editable.prototype.getRangeSnapshot = function(dirtyRange) {
    return {
      scLoc: this.getNodeLocation(dirtyRange.startContainer),
      scOffset: this.getRealNodeOffset(dirtyRange.startContainer, dirtyRange.startOffset),
      ecLoc: this.getNodeLocation(dirtyRange.endContainer),
      ecOffset: this.getRealNodeOffset(dirtyRange.endContainer, dirtyRange.endOffset)
    };
  };
  /**
   * @return {?}
   */
  obj.Editable.prototype.getSnapshot = function() {
    var data = {};
    if (data.html = this.$element.html(), data.ranges = [], this.selectionInEditor() && this.$element.is(":focus")) {
      var codeSegments = this.getRanges();
      /** @type {number} */
      var i = 0;
      for (; i < codeSegments.length; i++) {
        data.ranges.push(this.getRangeSnapshot(codeSegments[i]));
      }
    }
    return data;
  };
  /**
   * @param {Object} $scope
   * @param {Object} e
   * @return {?}
   */
  obj.Editable.prototype.identicSnapshots = function($scope, e) {
    return $scope.html != e.html ? false : JSON.stringify($scope.ranges) != JSON.stringify(e.ranges) ? false : true;
  };
  /**
   * @param {?} rng
   * @param {Selection} selection
   * @return {undefined}
   */
  obj.Editable.prototype.restoreRangeSnapshot = function(rng, selection) {
    try {
      var textNode1 = this.getNodeByLocation(rng.scLoc);
      var startOffset = rng.scOffset;
      var text2 = this.getNodeByLocation(rng.ecLoc);
      var endOffset = rng.ecOffset;
      var range = this.document.createRange();
      range.setStart(textNode1, startOffset);
      range.setEnd(text2, endOffset);
      selection.addRange(range);
    } catch (h) {}
  };
  /**
   * @param {Object} data
   * @return {undefined}
   */
  obj.Editable.prototype.restoreSnapshot = function(data) {
    if (this.$element.html() != data.html) {
      this.$element.html(data.html);
    }
    var selection = this.getSelection();
    this.clearSelection();
    this.$element.focus();
    /** @type {number} */
    var i = 0;
    for (; i < data.ranges.length; i++) {
      this.restoreRangeSnapshot(data.ranges[i], selection);
    }
    setTimeout(obj.proxy(function() {
      this.$element.find(".f-img-wrap img").click();
    }, this), 0);
  };
}(jQuery),
function($) {
  /**
   * @param {boolean} dataAndEvents
   * @return {?}
   */
  $.Editable.prototype.refreshButtons = function(dataAndEvents) {
    return this.initialized && (this.selectionInEditor() && !this.isHTML || (this.browser.msie && $.Editable.getIEversion() < 9 || dataAndEvents)) ? (this.$editor.find("button[data-cmd]").removeClass("active"), this.refreshDisabledState(), void this.raiseEvent("refresh")) : false;
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.refreshDisabledState = function() {
    if (this.isHTML) {
      return false;
    }
    if (this.$editor) {
      /** @type {number} */
      var n = 0;
      for (; n < this.options.buttons.length; n++) {
        var action = this.options.buttons[n];
        if (void 0 !== $.Editable.commands[action]) {
          /** @type {boolean} */
          var d = false;
          if ($.isFunction($.Editable.commands[action].disabled)) {
            d = $.Editable.commands[action].disabled.apply(this);
          } else {
            if (void 0 !== $.Editable.commands[action].disabled) {
              /** @type {boolean} */
              d = true;
            }
          }
          if (d) {
            this.$editor.find('button[data-cmd="' + action + '"]').prop("disabled", true);
            this.$editor.find('button[data-name="' + action + '"]').prop("disabled", true);
          } else {
            this.$editor.find('button[data-cmd="' + action + '"]').removeAttr("disabled");
            this.$editor.find('button[data-name="' + action + '"]').removeAttr("disabled");
          }
        }
      }
      this.refreshUndo();
      this.refreshRedo();
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.refreshFormatBlocks = function() {
    var elem = this.getSelectionElements()[0];
    var val = elem.tagName.toLowerCase();
    if (this.options.paragraphy) {
      if (val === this.options.defaultTag.toLowerCase()) {
        /** @type {string} */
        val = "n";
      }
    }
    this.$editor.find('.fr-bttn > button[data-name="formatBlock"] + ul li').removeClass("active");
    this.$bttn_wrapper.find('.fr-bttn > button[data-name="formatBlock"] + ul li[data-val="' + val + '"]').addClass("active");
  };
  /**
   * @param {string} command
   * @return {undefined}
   */
  $.Editable.prototype.refreshDefault = function(command) {
    try {
      if (this.document.queryCommandState(command) === true) {
        this.$editor.find('[data-cmd="' + command + '"]').addClass("active");
      }
    } catch (b) {}
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.refreshAlign = function() {
    var $button = $(this.getSelectionElements()[0]);
    this.$editor.find('.fr-dropdown > button[data-name="align"] + ul li').removeClass("active");
    var justifyRight;
    var direction = $button.css("text-align");
    if (["left", "right", "justify", "center"].indexOf(direction) < 0) {
      /** @type {string} */
      direction = "left";
    }
    if ("left" == direction) {
      /** @type {string} */
      justifyRight = "justifyLeft";
    } else {
      if ("right" == direction) {
        /** @type {string} */
        justifyRight = "justifyRight";
      } else {
        if ("justify" == direction) {
          /** @type {string} */
          justifyRight = "justifyFull";
        } else {
          if ("center" == direction) {
            /** @type {string} */
            justifyRight = "justifyCenter";
          }
        }
      }
    }
    this.$editor.find('.fr-dropdown > button[data-name="align"].fr-trigger i').attr("class", "fa fa-align-" + direction);
    this.$editor.find('.fr-dropdown > button[data-name="align"] + ul li[data-val="' + justifyRight + '"]').addClass("active");
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.refreshHTML = function() {
    if (this.isActive("html")) {
      this.$editor.find('[data-cmd="html"]').addClass("active");
    } else {
      this.$editor.find('[data-cmd="html"]').removeClass("active");
    }
  };
}(jQuery),
function($) {
  $.Editable.commands = {
    bold: {
      title: "Bold",
      icon: "fa fa-bold",
      shortcut: "(Ctrl + B)",
      refresh: $.Editable.prototype.refreshDefault,
      undo: true,
      /**
       * @param {?} undef
       * @return {undefined}
       */
      callbackWithoutSelection: function(undef) {
        this._startInDefault(undef);
      }
    },
    italic: {
      title: "Italic",
      icon: "fa fa-italic",
      shortcut: "(Ctrl + I)",
      refresh: $.Editable.prototype.refreshDefault,
      undo: true,
      /**
       * @param {?} undef
       * @return {undefined}
       */
      callbackWithoutSelection: function(undef) {
        this._startInDefault(undef);
      }
    },
    underline: {
      cmd: "underline",
      title: "Underline",
      icon: "fa fa-underline",
      shortcut: "(Ctrl + U)",
      refresh: $.Editable.prototype.refreshDefault,
      undo: true,
      /**
       * @param {?} undef
       * @return {undefined}
       */
      callbackWithoutSelection: function(undef) {
        this._startInDefault(undef);
      }
    },
    strikeThrough: {
      title: "Strikethrough",
      icon: "fa fa-strikethrough",
      refresh: $.Editable.prototype.refreshDefault,
      undo: true,
      /**
       * @param {?} undef
       * @return {undefined}
       */
      callbackWithoutSelection: function(undef) {
        this._startInDefault(undef);
      }
    },
    subscript: {
      title: "Subscript",
      icon: "fa fa-subscript",
      refresh: $.Editable.prototype.refreshDefault,
      undo: true,
      /**
       * @param {?} undef
       * @return {undefined}
       */
      callbackWithoutSelection: function(undef) {
        this._startInDefault(undef);
      }
    },
    superscript: {
      title: "Superscript",
      icon: "fa fa-superscript",
      refresh: $.Editable.prototype.refreshDefault,
      undo: true,
      /**
       * @param {?} undef
       * @return {undefined}
       */
      callbackWithoutSelection: function(undef) {
        this._startInDefault(undef);
      }
    },
    formatBlock: {
      title: "Format Block",
      icon: "fa fa-paragraph",
      refreshOnShow: $.Editable.prototype.refreshFormatBlocks,
      /**
       * @param {?} __
       * @param {string} match
       * @return {undefined}
       */
      callback: function(__, match) {
        this.formatBlock(match);
      },
      undo: true
    },
    align: {
      title: "Alignment",
      icon: "fa fa-align-left",
      refresh: $.Editable.prototype.refreshAlign,
      refreshOnShow: $.Editable.prototype.refreshAlign,
      seed: [{
        cmd: "justifyLeft",
        title: "Align Left",
        icon: "fa fa-align-left"
      }, {
        cmd: "justifyCenter",
        title: "Align Center",
        icon: "fa fa-align-center"
      }, {
        cmd: "justifyRight",
        title: "Align Right",
        icon: "fa fa-align-right"
      }, {
        cmd: "justifyFull",
        title: "Justify",
        icon: "fa fa-align-justify"
      }],
      /**
       * @param {?} __
       * @param {Object} type
       * @return {undefined}
       */
      callback: function(__, type) {
        this.align(type);
      },
      undo: true
    },
    outdent: {
      title: "Indent Less",
      icon: "fa fa-dedent",
      activeless: true,
      shortcut: "(Ctrl + <)",
      /**
       * @return {undefined}
       */
      callback: function() {
        this.outdent(true);
      },
      undo: true
    },
    indent: {
      title: "Indent More",
      icon: "fa fa-indent",
      activeless: true,
      shortcut: "(Ctrl + >)",
      /**
       * @return {undefined}
       */
      callback: function() {
        this.indent();
      },
      undo: true
    },
    selectAll: {
      title: "Select All",
      icon: "fa fa-file-text",
      shortcut: "(Ctrl + A)",
      /**
       * @param {string} label
       * @param {?} success
       * @return {undefined}
       */
      callback: function(label, success) {
        this.$element.focus();
        this.execDefault(label, success);
      },
      undo: false
    },
    createLink: {
      title: "Insert Link",
      icon: "fa fa-link",
      shortcut: "(Ctrl + K)",
      /**
       * @return {undefined}
       */
      callback: function() {
        this.insertLink();
      },
      undo: false
    },
    insertImage: {
      title: "Insert Image",
      icon: "fa fa-picture-o",
      activeless: true,
      shortcut: "(Ctrl + P)",
      /**
       * @return {undefined}
       */
      callback: function() {
        this.insertImage();
      },
      undo: false
    },
    undo: {
      title: "Undo",
      icon: "fa fa-undo",
      activeless: true,
      shortcut: "(Ctrl+Z)",
      refresh: $.Editable.prototype.refreshUndo,
      /**
       * @return {undefined}
       */
      callback: function() {
        this.undo();
      },
      undo: false
    },
    redo: {
      title: "Redo",
      icon: "fa fa-repeat",
      activeless: true,
      shortcut: "(Shift+Ctrl+Z)",
      refresh: $.Editable.prototype.refreshRedo,
      /**
       * @return {undefined}
       */
      callback: function() {
        this.redo();
      },
      undo: false
    },
    html: {
      title: "Show HTML",
      icon: "fa fa-code",
      refresh: $.Editable.prototype.refreshHTML,
      /**
       * @return {undefined}
       */
      callback: function() {
        this.html();
      },
      undo: false
    },
    save: {
      title: "Save",
      icon: "fa fa-floppy-o",
      /**
       * @return {undefined}
       */
      callback: function() {
        this.save();
      },
      undo: false
    },
    insertHorizontalRule: {
      title: "Insert Horizontal Line",
      icon: "fa fa-minus",
      /**
       * @param {string} label
       * @return {undefined}
       */
      callback: function(label) {
        this.insertHR(label);
      },
      undo: true
    },
    removeFormat: {
      title: "Clear formatting",
      icon: "fa fa-eraser",
      activeless: true,
      /**
       * @return {undefined}
       */
      callback: function() {
        this.removeFormat();
      },
      undo: true
    }
  };
  /**
   * @param {string} name
   * @param {?} callback
   * @param {?} args
   * @return {?}
   */
  $.Editable.prototype.exec = function(name, callback, args) {
    return !this.selectionInEditor() && ($.Editable.commands[name].undo && this.focus()), this.selectionInEditor() && ("" === this.text() && $.Editable.commands[name].callbackWithoutSelection) ? ($.Editable.commands[name].callbackWithoutSelection.apply(this, [name, callback, args]), false) : void($.Editable.commands[name].callback ? $.Editable.commands[name].callback.apply(this, [name, callback, args]) : this.execDefault(name, callback));
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.html = function() {
    var result;
    if (this.isHTML) {
      /** @type {boolean} */
      this.isHTML = false;
      result = this.$html_area.val();
      this.$box.removeClass("f-html");
      this.$element.attr("contenteditable", true);
      this.setHTML(result, false);
      this.$editor.find('.fr-bttn:not([data-cmd="html"]), .fr-trigger').removeAttr("disabled");
      this.$editor.find('.fr-bttn[data-cmd="html"]').removeClass("active");
      this.$element.blur();
      this.focus();
      this.refreshButtons();
      this.triggerEvent("htmlHide", [result], true, false);
    } else {
      this.$box.removeClass("f-placeholder");
      this.clearSelection();
      this.cleanify(false, true, false);
      result = this.cleanTags(this.getHTML(false, false));
      this.$html_area.val(result).trigger("resize");
      this.$html_area.css("height", this.$element.height() - 1);
      this.$element.html("").append(this.$html_area).removeAttr("contenteditable");
      this.$box.addClass("f-html");
      this.$editor.find('button.fr-bttn:not([data-cmd="html"]), button.fr-trigger').attr("disabled", true);
      this.$editor.find('.fr-bttn[data-cmd="html"]').addClass("active");
      /** @type {boolean} */
      this.isHTML = true;
      this.hide();
      /** @type {boolean} */
      this.imageMode = false;
      this.$element.blur();
      this.$element.removeAttr("contenteditable");
      this.triggerEvent("htmlShow", [result], true, false);
    }
  };
  /**
   * @param {string} name
   * @return {undefined}
   */
  $.Editable.prototype.insertHR = function(name) {
    this.$element.find("hr").addClass("fr-tag");
    if (this.$element.hasClass("f-placeholder")) {
      $(this.$element.find("> " + this.valid_nodes.join(", >"))[0]).before("<hr/>");
    } else {
      this.document.execCommand(name);
    }
    this.hide();
    var _queries = this.$element.find("hr:not(.fr-tag)").next(this.valid_nodes.join(","));
    if (_queries.length > 0) {
      $(_queries[0]).prepend(this.markers_html);
    } else {
      this.$element.find("hr:not(.fr-tag)").after(this.options.paragraphy ? "<p>" + this.markers_html + "<br/></p>" : this.markers_html);
    }
    this.restoreSelectionByMarkers();
    this.triggerEvent(name, [], true, false);
  };
  /**
   * @param {string} name
   * @return {?}
   */
  $.Editable.prototype.formatBlock = function(name) {
    if (this.disabledList.indexOf("formatBlock") >= 0) {
      return false;
    }
    if (this.browser.msie && $.Editable.getIEversion() < 9) {
      return "n" == name && (name = this.options.defaultTag), this.document.execCommand("formatBlock", false, "<" + name + ">"), this.triggerEvent("formatBlock"), false;
    }
    if (this.$element.hasClass("f-placeholder")) {
      if (this.options.paragraphy || "n" != name) {
        if ("n" == name) {
          name = this.options.defaultTag;
        }
        var text = $("<" + name + "><br/></" + name + ">");
        this.$element.html(text);
        this.setSelection(text.get(0), 0);
        this.$element.removeClass("f-placeholder");
      }
    } else {
      this.saveSelectionByMarkers();
      this.wrapText();
      this.restoreSelectionByMarkers();
      var codeSegments = this.getSelectionElements();
      if (codeSegments[0] == this.$element.get(0)) {
        codeSegments = this.$element.find("> " + this.valid_nodes.join(", >"));
      }
      this.saveSelectionByMarkers();
      var content;
      /**
       * @param {Object} results
       * @return {undefined}
       */
      var select = function(results) {
        if ("PRE" == results.get(0).tagName) {
          for (; results.find("br + br").length > 0;) {
            var $this = $(results.find("br + br")[0]);
            $this.prev().remove();
            $this.replaceWith("\n\n");
          }
        }
      };
      /** @type {number} */
      var i = 0;
      for (; i < codeSegments.length; i++) {
        var parent = $(codeSegments[i]);
        if (!this.fakeEmpty(parent)) {
          if (select(parent), !this.options.paragraphy && (this.emptyElement(parent.get(0)) && parent.append("<br/>")), "n" == name) {
            if (this.options.paragraphy) {
              /** @type {string} */
              var rawContent = "<" + this.options.defaultTag + this.attrs(parent.get(0)) + ">" + parent.html() + "</" + this.options.defaultTag + ">";
              content = $(rawContent);
            } else {
              content = parent.html() + "<br/>";
            }
          } else {
            content = $("<" + name + this.attrs(parent.get(0)) + ">").html(parent.html());
          }
          if (parent.get(0) != this.$element.get(0)) {
            parent.replaceWith(content);
          } else {
            parent.html(content);
          }
        }
      }
      this.unwrapText();
      this.$element.find("pre + pre").each(function() {
        $(this).prepend($(this).prev().html() + "<br/><br/>");
        $(this).prev().remove();
      });
      var ignores = this;
      this.$element.find(this.valid_nodes.join(",")).each(function() {
        if ("PRE" != this.tagName) {
          $(this).replaceWith("<" + this.tagName + ignores.attrs(this) + ">" + $(this).html().replace(/\n\n/gi, "</" + this.tagName + "><" + this.tagName + ">") + "</" + this.tagName + ">");
        }
      });
      this.$element.find(this.valid_nodes.join(":empty ,") + ":empty").append("<br/>");
      this.cleanupLists();
      this.restoreSelectionByMarkers();
    }
    this.triggerEvent("formatBlock");
    this.repositionEditor();
  };
  /**
   * @param {string} align
   * @return {?}
   */
  $.Editable.prototype.align = function(align) {
    if (this.browser.msie && $.Editable.getIEversion() < 9) {
      return this.document.execCommand(align, false, false), this.triggerEvent("align", [align]), false;
    }
    this.saveSelectionByMarkers();
    this.wrapText();
    this.restoreSelectionByMarkers();
    this.saveSelectionByMarkers();
    var codeSegments = this.getSelectionElements();
    if ("justifyLeft" == align) {
      /** @type {string} */
      align = "left";
    } else {
      if ("justifyRight" == align) {
        /** @type {string} */
        align = "right";
      } else {
        if ("justifyCenter" == align) {
          /** @type {string} */
          align = "center";
        } else {
          if ("justifyFull" == align) {
            /** @type {string} */
            align = "justify";
          }
        }
      }
    }
    /** @type {number} */
    var i = 0;
    for (; i < codeSegments.length; i++) {
      if (this.parents($(codeSegments[i]), "LI").length > 0) {
        codeSegments[i] = $(codeSegments[i]).parents("LI").get(0);
      }
      $(codeSegments[i]).css("text-align", align);
    }
    this.cleanupLists();
    this.unwrapText();
    this.restoreSelectionByMarkers();
    this.repositionEditor();
    this.triggerEvent("align", [align]);
  };
  /**
   * @param {boolean} dataAndEvents
   * @param {boolean} deepDataAndEvents
   * @return {?}
   */
  $.Editable.prototype.indent = function(dataAndEvents, deepDataAndEvents) {
    if (void 0 === deepDataAndEvents && (deepDataAndEvents = true), this.browser.msie && $.Editable.getIEversion() < 9) {
      return dataAndEvents ? this.document.execCommand("outdent", false, false) : this.document.execCommand("indent", false, false), false;
    }
    /** @type {number} */
    var offset = 20;
    if (dataAndEvents) {
      /** @type {number} */
      offset = -20;
    }
    this.saveSelectionByMarkers();
    this.wrapText();
    this.restoreSelectionByMarkers();
    var cells = this.getSelectionElements();
    this.saveSelectionByMarkers();
    /** @type {number} */
    var i = 0;
    for (; i < cells.length; i++) {
      if ($(cells[i]).parentsUntil(this.$element, "li").length > 0) {
        cells[i] = $(cells[i]).closest("li").get(0);
      }
    }
    /** @type {number} */
    var ci = 0;
    for (; ci < cells.length; ci++) {
      var $el = $(cells[ci]);
      if (this.raiseEvent("indent", [$el, dataAndEvents])) {
        if ($el.get(0) != this.$element.get(0)) {
          /** @type {number} */
          var length = parseInt($el.css("margin-left"), 10);
          /** @type {number} */
          var newZIndex = Math.max(0, length + offset);
          $el.css("marginLeft", newZIndex);
          if (0 === newZIndex) {
            $el.css("marginLeft", "");
            if (void 0 === $el.css("style")) {
              $el.removeAttr("style");
            }
          }
        } else {
          var el = $("<div>").html($el.html());
          $el.html(el);
          el.css("marginLeft", Math.max(0, offset));
          if (0 === Math.max(0, offset)) {
            el.css("marginLeft", "");
            if (void 0 === el.css("style")) {
              el.removeAttr("style");
            }
          }
        }
      }
    }
    this.unwrapText();
    this.restoreSelectionByMarkers();
    if (deepDataAndEvents) {
      this.repositionEditor();
    }
    if (!dataAndEvents) {
      this.triggerEvent("indent");
    }
  };
  /**
   * @param {boolean} deepDataAndEvents
   * @return {undefined}
   */
  $.Editable.prototype.outdent = function(deepDataAndEvents) {
    this.indent(true, deepDataAndEvents);
    this.triggerEvent("outdent");
  };
  /**
   * @param {string} name
   * @param {?} arg
   * @return {undefined}
   */
  $.Editable.prototype.execDefault = function(name, arg) {
    this.saveUndoStep();
    this.document.execCommand(name, false, arg);
    this.triggerEvent(name, [], true, true);
  };
  /**
   * @param {?} command
   * @return {undefined}
   */
  $.Editable.prototype._startInDefault = function(command) {
    this.focus();
    this.document.execCommand(command, false, false);
    this.refreshButtons();
  };
  /**
   * @param {string} dataAndEvents
   * @param {string} events
   * @param {string} mouseInfo
   * @return {undefined}
   */
  $.Editable.prototype._startInFontExec = function(dataAndEvents, events, mouseInfo) {
    this.focus();
    try {
      var rng = this.getRange();
      var textRange = rng.cloneRange();
      textRange.collapse(false);
      var element = $('<span data-inserted="true" data-fr-verified="true" style="' + dataAndEvents + ": " + mouseInfo + ';">' + $.Editable.INVISIBLE_SPACE + "</span>", this.document);
      textRange.insertNode(element[0]);
      element = this.$element.find("[data-inserted]");
      element.removeAttr("data-inserted");
      this.setSelection(element.get(0), 1);
      if (null != events) {
        this.triggerEvent(events, [mouseInfo], true, true);
      }
    } catch (h) {}
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.removeFormat = function() {
    this.document.execCommand("removeFormat", false, false);
    this.document.execCommand("unlink", false, false);
    this.refreshButtons();
  };
  /**
   * @param {string} type
   * @param {string} events
   * @param {string} mouseInfo
   * @return {undefined}
   */
  $.Editable.prototype.inlineStyle = function(type, events, mouseInfo) {
    if (this.browser.webkit) {
      /**
       * @param {HTMLElement} temp
       * @return {?}
       */
      var createPopup = function(temp) {
        return temp.attr("style").indexOf("font-size") >= 0;
      };
      this.$element.find("[style]").each(function(dataAndEvents, items) {
        var temp = $(items);
        if (createPopup(temp)) {
          temp.attr("data-font-size", temp.css("font-size"));
          temp.css("font-size", "");
        }
      });
    }
    this.document.execCommand("fontSize", false, 4);
    this.saveSelectionByMarkers();
    if (this.browser.webkit) {
      this.$element.find("[data-font-size]").each(function(dataAndEvents, element) {
        var $element = $(element);
        $element.css("font-size", $element.attr("data-font-size"));
        $element.removeAttr("data-font-size");
      });
    }
    /**
     * @param {?} elem
     * @return {undefined}
     */
    var create = function(elem) {
      var $elem = $(elem);
      if ($elem.css(type) != mouseInfo) {
        $elem.css(type, "");
      }
      if ("" === $elem.attr("style")) {
        $elem.replaceWith($elem.html());
      }
    };
    this.$element.find("font").each(function(dataAndEvents, element) {
      var $elem = $('<span data-fr-verified="true" style="' + type + ": " + mouseInfo + ';">' + $(element).html() + "</span>");
      $(element).replaceWith($elem);
      var codeSegments = $elem.find("span");
      /** @type {number} */
      var i = codeSegments.length - 1;
      for (; i >= 0; i--) {
        create(codeSegments[i]);
      }
    });
    this.removeBlankSpans();
    this.restoreSelectionByMarkers();
    this.repositionEditor();
    if (null != events) {
      this.triggerEvent(events, [mouseInfo], true, true);
    }
  };
}(jQuery),
function(obj) {
  /**
   * @param {string} eventName
   * @param {?} listener
   * @return {undefined}
   */
  obj.Editable.prototype.addListener = function(eventName, listener) {
    var events = this._events;
    var onCreateListeners = events[eventName] = events[eventName] || [];
    onCreateListeners.push(listener);
  };
  /**
   * @param {string} type
   * @param {?} data
   * @return {?}
   */
  obj.Editable.prototype.raiseEvent = function(type, data) {
    if (void 0 === data) {
      /** @type {Array} */
      data = [];
    }
    /** @type {boolean} */
    var buffered = true;
    var list = this._events[type];
    if (list) {
      /** @type {number} */
      var firingIndex = 0;
      var listLength = list.length;
      for (; listLength > firingIndex; firingIndex++) {
        var buf = list[firingIndex].apply(this, data);
        if (void 0 !== buf) {
          if (buffered !== false) {
            buffered = buf;
          }
        }
      }
    }
    return void 0 === buffered && (buffered = true), buffered;
  };
}(jQuery),
function($) {
  /** @type {string} */
  $.Editable.prototype.start_marker = '<span class="f-marker" data-id="0" data-fr-verified="true" data-type="true"></span>';
  /** @type {string} */
  $.Editable.prototype.end_marker = '<span class="f-marker" data-id="0" data-fr-verified="true" data-type="false"></span>';
  /** @type {string} */
  $.Editable.prototype.markers_html = '<span class="f-marker" data-id="0" data-fr-verified="true" data-type="false"></span><span class="f-marker" data-id="0" data-fr-verified="true" data-type="true"></span>';
  /**
   * @return {?}
   */
  $.Editable.prototype.text = function() {
    /** @type {string} */
    var text = "";
    return this.window.getSelection ? text = this.window.getSelection() : this.document.getSelection ? text = this.document.getSelection() : this.document.selection && (text = this.document.selection.createRange().text), text.toString();
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.selectionInEditor = function() {
    var selector = this.getSelectionParent();
    /** @type {boolean} */
    var m = false;
    return selector == this.$element.get(0) && (m = true), m === false && $(selector).parents().each($.proxy(function(dataAndEvents, deepDataAndEvents) {
      if (deepDataAndEvents == this.$element.get(0)) {
        /** @type {boolean} */
        m = true;
      }
    }, this)), m;
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.getSelection = function() {
    /** @type {string} */
    var optsData = "";
    return optsData = this.window.getSelection ? this.window.getSelection() : this.document.getSelection ? this.document.getSelection() : this.document.selection.createRange();
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.getRange = function() {
    var codeSegments = this.getRanges();
    return codeSegments.length > 0 ? codeSegments[0] : null;
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.getRanges = function() {
    var sel = this.getSelection();
    if (sel.getRangeAt && sel.rangeCount) {
      /** @type {Array} */
      var colNames = [];
      /** @type {number} */
      var i = 0;
      for (; i < sel.rangeCount; i++) {
        colNames.push(sel.getRangeAt(i));
      }
      return colNames;
    }
    return this.document.createRange ? [this.document.createRange()] : [];
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.clearSelection = function() {
    var sel = this.getSelection();
    try {
      if (sel.removeAllRanges) {
        sel.removeAllRanges();
      } else {
        if (sel.empty) {
          sel.empty();
        } else {
          if (sel.clear) {
            sel.clear();
          }
        }
      }
    } catch (b) {}
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.getSelectionElement = function() {
    var selection = this.getSelection();
    if (selection && selection.rangeCount) {
      var range = this.getRange();
      var element = range.startContainer;
      if (1 == element.nodeType) {
        /** @type {boolean} */
        var e = false;
        if (element.childNodes.length > 0) {
          if (element.childNodes[range.startOffset]) {
            if ($(element.childNodes[range.startOffset]).text() === this.text()) {
              element = element.childNodes[range.startOffset];
              /** @type {boolean} */
              e = true;
            }
          }
        }
        if (!e) {
          if (element.childNodes.length > 0) {
            if ($(element.childNodes[0]).text() === this.text()) {
              if (["BR", "IMG", "HR"].indexOf(element.childNodes[0].tagName) < 0) {
                element = element.childNodes[0];
              }
            }
          }
        }
      }
      for (; 1 != element.nodeType && element.parentNode;) {
        element = element.parentNode;
      }
      var child = element;
      for (; child && "BODY" != child.tagName;) {
        if (child == this.$element.get(0)) {
          return element;
        }
        child = $(child).parent()[0];
      }
    }
    return this.$element.get(0);
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.getSelectionParent = function() {
    var selection;
    /** @type {null} */
    var element = null;
    return this.window.getSelection ? (selection = this.window.getSelection(), selection && (selection.rangeCount && (element = selection.getRangeAt(0).commonAncestorContainer, 1 != element.nodeType && (element = element.parentNode)))) : (selection = this.document.selection) && ("Control" != selection.type && (element = selection.createRange().parentElement())), null != element && ($.inArray(this.$element.get(0), $(element).parents()) >= 0 || element == this.$element.get(0)) ? element : null;
  };
  /**
   * @param {?} range
   * @param {?} element
   * @return {?}
   */
  $.Editable.prototype.nodeInRange = function(range, element) {
    var range2;
    if (range.intersectsNode) {
      return range.intersectsNode(element);
    }
    range2 = element.ownerthis.document.createRange();
    try {
      range2.selectNode(element);
    } catch (d) {
      range2.selectNodeContents(element);
    }
    return -1 == range.compareBoundaryPoints(Range.END_TO_START, range2) && 1 == range.compareBoundaryPoints(Range.START_TO_END, range2);
  };
  /**
   * @param {Node} el
   * @return {?}
   */
  $.Editable.prototype.getElementFromNode = function(el) {
    if (1 != el.nodeType) {
      el = el.parentNode;
    }
    for (; null !== el && this.valid_nodes.indexOf(el.tagName) < 0;) {
      el = el.parentNode;
    }
    return null != el && ("LI" == el.tagName && $(el).find(this.valid_nodes.join(",")).not("li").length > 0) ? null : $.makeArray($(el).parents()).indexOf(this.$element.get(0)) >= 0 ? el : null;
  };
  /**
   * @param {HTMLElement} node
   * @param {HTMLElement} root
   * @return {?}
   */
  $.Editable.prototype.nextNode = function(node, root) {
    if (node.hasChildNodes()) {
      return node.firstChild;
    }
    for (; node && (!node.nextSibling && node != root);) {
      node = node.parentNode;
    }
    return node && node != root ? node.nextSibling : null;
  };
  /**
   * @param {Object} obj
   * @return {?}
   */
  $.Editable.prototype.getRangeSelectedNodes = function(obj) {
    /** @type {Array} */
    var results = [];
    var el = obj.startContainer;
    var value = obj.endContainer;
    if (el == value && "TR" != el.tagName) {
      if (el.hasChildNodes() && 0 !== el.childNodes.length) {
        var nodes = el.childNodes;
        var index = obj.startOffset;
        for (; index < obj.endOffset; index++) {
          if (nodes[index]) {
            results.push(nodes[index]);
          }
        }
        return 0 === results.length && results.push(el), results;
      }
      return [el];
    }
    if (el == value && "TR" == el.tagName) {
      var childNodes = el.childNodes;
      var offset = obj.startOffset;
      if (childNodes.length > offset && offset >= 0) {
        var child = childNodes[offset];
        if ("TD" == child.tagName || "TH" == child.tagName) {
          return [child];
        }
      }
    }
    for (; el && el != value;) {
      el = this.nextNode(el, value);
      if (el != value || obj.endOffset > 0) {
        results.push(el);
      }
    }
    el = obj.startContainer;
    for (; el && el != obj.commonAncestorContainer;) {
      results.unshift(el);
      el = el.parentNode;
    }
    return results;
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.getSelectedNodes = function() {
    if (this.window.getSelection) {
      var selection = this.window.getSelection();
      if (!selection.isCollapsed) {
        var codeSegments = this.getRanges();
        /** @type {Array} */
        var nodes = [];
        /** @type {number} */
        var i = 0;
        for (; i < codeSegments.length; i++) {
          nodes = $.merge(nodes, this.getRangeSelectedNodes(codeSegments[i]));
        }
        return nodes;
      }
      if (this.selectionInEditor()) {
        var node = selection.getRangeAt(0).startContainer;
        return 3 == node.nodeType ? [node.parentNode] : [node];
      }
    }
    return [];
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.getSelectionElements = function() {
    var nodes = this.getSelectedNodes();
    /** @type {Array} */
    var arr = [];
    return $.each(nodes, $.proxy(function(dataAndEvents, selector) {
      if (null !== selector) {
        var chunk = this.getElementFromNode(selector);
        if (arr.indexOf(chunk) < 0) {
          if (chunk != this.$element.get(0)) {
            if (null !== chunk) {
              arr.push(chunk);
            }
          }
        }
      }
    }, this)), 0 === arr.length && arr.push(this.$element.get(0)), arr;
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.getSelectionLink = function() {
    var _queries = this.getSelectionLinks();
    return _queries.length > 0 ? $(_queries[0]).attr("href") : null;
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.saveSelection = function() {
    if (!this.selectionDisabled) {
      /** @type {Array} */
      this.savedRanges = [];
      var codeSegments = this.getRanges();
      /** @type {number} */
      var i = 0;
      for (; i < codeSegments.length; i++) {
        this.savedRanges.push(codeSegments[i].cloneRange());
      }
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.restoreSelection = function() {
    if (!this.selectionDisabled) {
      var i;
      var ilen;
      var selection = this.getSelection();
      if (this.savedRanges && this.savedRanges.length) {
        selection.removeAllRanges();
        /** @type {number} */
        i = 0;
        ilen = this.savedRanges.length;
        for (; ilen > i; i += 1) {
          selection.addRange(this.savedRanges[i]);
        }
      }
      /** @type {null} */
      this.savedRanges = null;
    }
  };
  /**
   * @param {Event} e
   * @return {undefined}
   */
  $.Editable.prototype.insertMarkersAtPoint = function(e) {
    var x = e.clientX;
    var y = e.clientY;
    this.removeMarkers();
    var ref;
    /** @type {null} */
    var range = null;
    if ("undefined" != typeof this.document.caretPositionFromPoint ? (ref = this.document.caretPositionFromPoint(x, y), range = this.document.createRange(), range.setStart(ref.offsetNode, ref.offset), range.setEnd(ref.offsetNode, ref.offset)) : "undefined" != typeof this.document.caretRangeFromPoint && (ref = this.document.caretRangeFromPoint(x, y), range = this.document.createRange(), range.setStart(ref.startContainer, ref.startOffset), range.setEnd(ref.startContainer, ref.startOffset)), null !==
      range && "undefined" != typeof this.window.getSelection) {
      var selection = this.window.getSelection();
      selection.removeAllRanges();
      selection.addRange(range);
    } else {
      if ("undefined" != typeof this.document.body.createTextRange) {
        try {
          range = this.document.body.createTextRange();
          range.moveToPoint(x, y);
          var rangeEnd = range.duplicate();
          rangeEnd.moveToPoint(x, y);
          range.setEndPoint("EndToEnd", rangeEnd);
          range.select();
        } catch (h) {}
      }
    }
    this.placeMarker(range, true, 0);
    this.placeMarker(range, false, 0);
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.saveSelectionByMarkers = function() {
    if (!this.selectionDisabled) {
      if (!this.selectionInEditor()) {
        this.focus();
      }
      this.removeMarkers();
      var resultItems = this.getRanges();
      /** @type {number} */
      var i = 0;
      for (; i < resultItems.length; i++) {
        if (resultItems[i].startContainer !== this.document) {
          var result = resultItems[i];
          this.placeMarker(result, true, i);
          this.placeMarker(result, false, i);
        }
      }
    }
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.hasSelectionByMarkers = function() {
    var codeSegments = this.$element.find('.f-marker[data-type="true"]');
    return codeSegments.length > 0 ? true : false;
  };
  /**
   * @param {boolean} dataAndEvents
   * @return {?}
   */
  $.Editable.prototype.restoreSelectionByMarkers = function(dataAndEvents) {
    if (void 0 === dataAndEvents && (dataAndEvents = true), !this.selectionDisabled) {
      var codeSegments = this.$element.find('.f-marker[data-type="true"]');
      if (0 === codeSegments.length) {
        return false;
      }
      if (!this.$element.is(":focus")) {
        if (!this.browser.msie) {
          this.$element.focus();
        }
      }
      var selection = this.getSelection();
      if (dataAndEvents || (this.getRange() && !this.getRange().collapsed || !$(codeSegments[0]).attr("data-collapsed"))) {
        if (!(this.browser.msie && $.Editable.getIEversion() < 9)) {
          this.clearSelection();
          /** @type {boolean} */
          dataAndEvents = true;
        }
      }
      /** @type {number} */
      var i = 0;
      for (; i < codeSegments.length; i++) {
        var targetNode = $(codeSegments[i]).data("id");
        var start = codeSegments[i];
        var node = this.$element.find('.f-marker[data-type="false"][data-id="' + targetNode + '"]');
        if (this.browser.msie && $.Editable.getIEversion() < 9) {
          return this.setSelection(start, 0, node, 0), this.removeMarkers(), false;
        }
        var range;
        if (range = dataAndEvents ? this.document.createRange() : this.getRange(), node.length > 0) {
          node = node[0];
          try {
            range.setStartAfter(start);
            range.setEndBefore(node);
          } catch (j) {}
        }
        if (dataAndEvents) {
          selection.addRange(range);
        }
      }
      this.removeMarkers();
    }
  };
  /**
   * @param {(number|string)} node
   * @param {number} startOffset
   * @param {(number|string)} p
   * @param {number} endOffset
   * @return {undefined}
   */
  $.Editable.prototype.setSelection = function(node, startOffset, p, endOffset) {
    var selection = this.getSelection();
    if (selection) {
      this.clearSelection();
      try {
        if (!p) {
          /** @type {(number|string)} */
          p = node;
        }
        if (void 0 === startOffset) {
          /** @type {number} */
          startOffset = 0;
        }
        if (void 0 === endOffset) {
          /** @type {number} */
          endOffset = startOffset;
        }
        var range = this.getRange();
        range.setStart(node, startOffset);
        range.setEnd(p, endOffset);
        selection.addRange(range);
      } catch (g) {}
    }
  };
  /**
   * @param {Object} recurring
   * @param {number} isXML
   * @param {string} text
   * @return {?}
   */
  $.Editable.prototype.buildMarker = function(recurring, isXML, text) {
    return void 0 === text && (text = ""), $('<span class="f-marker"' + text + ' style="display:none; line-height: 0;" data-fr-verified="true" data-id="' + isXML + '" data-type="' + recurring + '">', this.document)[0];
  };
  /**
   * @param {Object} range
   * @param {boolean} recurring
   * @param {number} isXML
   * @return {undefined}
   */
  $.Editable.prototype.placeMarker = function(range, recurring, isXML) {
    /** @type {string} */
    var later = "";
    if (range.collapsed) {
      /** @type {string} */
      later = ' data-collapsed="true"';
    }
    try {
      var clone1 = range.cloneRange();
      clone1.collapse(recurring);
      var element;
      var elements;
      var item;
      if (clone1.insertNode(this.buildMarker(recurring, isXML, later)), recurring === true && later) {
        element = this.$element.find('span.f-marker[data-type="true"][data-id="' + isXML + '"]').get(0).nextSibling;
        for (; 3 === element.nodeType && 0 === element.data.length;) {
          $(element).remove();
          element = this.$element.find('span.f-marker[data-type="true"][data-id="' + isXML + '"]').get(0).nextSibling;
        }
      }
      if (recurring === true && ("" === later && (item = this.$element.find('span.f-marker[data-type="true"][data-id="' + isXML + '"]').get(0), element = item.nextSibling, element && (element.nodeType === Node.ELEMENT_NODE && this.valid_nodes.indexOf(element.tagName) >= 0)))) {
        /** @type {Array} */
        elements = [element];
        do {
          element = elements[0];
          elements = $(element).contents();
        } while (elements[0] && this.valid_nodes.indexOf(elements[0].tagName) >= 0);
        $(element).prepend($(item));
      }
      if (recurring === false && ("" === later && (item = this.$element.find('span.f-marker[data-type="false"][data-id="' + isXML + '"]').get(0), element = item.previousSibling, element && (element.nodeType === Node.ELEMENT_NODE && this.valid_nodes.indexOf(element.tagName) >= 0)))) {
        /** @type {Array} */
        elements = [element];
        do {
          element = elements[elements.length - 1];
          elements = $(element).contents();
        } while (elements[elements.length - 1] && this.valid_nodes.indexOf(elements[elements.length - 1].tagName) >= 0);
        $(element).append($(item));
      }
    } catch (j) {}
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.removeMarkers = function() {
    this.$element.find(".f-marker").remove();
  };
  /**
   * @param {(Node|string)} text
   * @return {?}
   */
  $.Editable.prototype.getSelectionTextInfo = function(text) {
    var constraint;
    var rng;
    /** @type {boolean} */
    var atStart = false;
    /** @type {boolean} */
    var atEnd = false;
    if (this.window.getSelection) {
      var sel = this.window.getSelection();
      if (sel) {
        if (sel.rangeCount) {
          constraint = sel.getRangeAt(0);
          rng = constraint.cloneRange();
          rng.selectNodeContents(text);
          rng.setEnd(constraint.startContainer, constraint.startOffset);
          /** @type {boolean} */
          atStart = "" === rng.toString();
          rng.selectNodeContents(text);
          rng.setStart(constraint.endContainer, constraint.endOffset);
          /** @type {boolean} */
          atEnd = "" === rng.toString();
        }
      }
    } else {
      if (this.document.selection) {
        if ("Control" != this.document.selection.type) {
          constraint = this.document.selection.createRange();
          rng = constraint.duplicate();
          rng.moveToElementText(text);
          rng.setEndPoint("EndToStart", constraint);
          /** @type {boolean} */
          atStart = "" === rng.text;
          rng.moveToElementText(text);
          rng.setEndPoint("StartToEnd", constraint);
          /** @type {boolean} */
          atEnd = "" === rng.text;
        }
      }
    }
    return {
      atStart: atStart,
      atEnd: atEnd
    };
  };
  /**
   * @param {string} str
   * @param {Array} suffix
   * @return {?}
   */
  $.Editable.prototype.endsWith = function(str, suffix) {
    return -1 !== str.indexOf(suffix, str.length - suffix.length);
  };
}(jQuery),
function($) {
  /**
   * @param {string} text
   * @return {?}
   */
  $.Editable.hexToRGB = function(text) {
    /** @type {RegExp} */
    var cx = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    text = text.replace(cx, function(dataAndEvents, r, g, b) {
      return r + r + g + g + b + b;
    });
    /** @type {(Array.<string>|null)} */
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(text);
    return result ? {
      r: parseInt(result[1], 16),
      g: parseInt(result[2], 16),
      b: parseInt(result[3], 16)
    } : null;
  };
  /**
   * @param {string} c
   * @return {?}
   */
  $.Editable.hexToRGBString = function(c) {
    var rgb = this.hexToRGB(c);
    return rgb ? "rgb(" + rgb.r + ", " + rgb.g + ", " + rgb.b + ")" : "";
  };
  /**
   * @param {string} val
   * @return {?}
   */
  $.Editable.RGBToHex = function(val) {
    /**
     * @param {?} s
     * @return {?}
     */
    function hex(s) {
      return ("0" + parseInt(s, 10).toString(16)).slice(-2);
    }
    try {
      return val && "transparent" !== val ? /^#[0-9A-F]{6}$/i.test(val) ? val : (val = val.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/), ("#" + hex(val[1]) + hex(val[2]) + hex(val[3])).toUpperCase()) : "";
    } catch (c) {
      return null;
    }
  };
  /**
   * @return {?}
   */
  $.Editable.getIEversion = function() {
    var source;
    var re;
    /** @type {number} */
    var q = -1;
    return "Microsoft Internet Explorer" == navigator.appName ? (source = navigator.userAgent, re = new RegExp("MSIE ([0-9]{1,}[\\.0-9]{0,})"), null !== re.exec(source) && (q = parseFloat(RegExp.$1))) : "Netscape" == navigator.appName && (source = navigator.userAgent, re = new RegExp("Trident/.*rv:([0-9]{1,}[\\.0-9]{0,})"), null !== re.exec(source) && (q = parseFloat(RegExp.$1))), q;
  };
  /**
   * @return {?}
   */
  $.Editable.browser = function() {
    var browser = {};
    if (this.getIEversion() > 0) {
      /** @type {boolean} */
      browser.msie = true;
    } else {
      /** @type {string} */
      var ua = navigator.userAgent.toLowerCase();
      /** @type {Array.<string>} */
      var segmentMatch = /(chrome)[ \/]([\w.]+)/.exec(ua) || (/(webkit)[ \/]([\w.]+)/.exec(ua) || (/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) || (/(msie) ([\w.]+)/.exec(ua) || (ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) || []))));
      var result = {
        browser: segmentMatch[1] || "",
        version: segmentMatch[2] || "0"
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
  };
  /**
   * @param {boolean} arr
   * @return {?}
   */
  $.Editable.isArray = function(arr) {
    return arr && (!arr.propertyIsEnumerable("length") && ("object" == typeof arr && "number" == typeof arr.length));
  };
  /**
   * @param {?} array
   * @return {?}
   */
  $.Editable.uniq = function(array) {
    return $.grep(array, function(arg, dataAndEvents) {
      return dataAndEvents == $.inArray(arg, array);
    });
  };
  /**
   * @param {string} element
   * @return {undefined}
   */
  $.Editable.cleanWhitespace = function(element) {
    element.contents().filter(function() {
      return 1 == this.nodeType && $.Editable.cleanWhitespace($(this)), 3 == this.nodeType && !/\S/.test(this.nodeValue);
    }).remove();
  };
}(jQuery),
function($) {
  /**
   * @param {Object} event
   * @return {undefined}
   */
  $.Editable.prototype.show = function(event) {
    if (this.hideDropdowns(), void 0 !== event) {
      if (this.options.inlineMode || this.options.editInPopup) {
        if (null !== event && "touchend" !== event.type) {
          if (this.options.showNextToCursor) {
            var x = event.pageX;
            var y = event.pageY;
            if (x < this.$element.offset().left) {
              x = this.$element.offset().left;
            }
            if (x > this.$element.offset().left + this.$element.width()) {
              x = this.$element.offset().left + this.$element.width();
            }
            if (y < this.$element.offset.top) {
              y = this.$element.offset().top;
            }
            if (y > this.$element.offset().top + this.$element.height()) {
              y = this.$element.offset().top + this.$element.height();
            }
            if (20 > x) {
              /** @type {number} */
              x = 20;
            }
            if (0 > y) {
              /** @type {number} */
              y = 0;
            }
            this.showByCoordinates(x, y);
          } else {
            this.repositionEditor();
          }
          $(".froala-editor:not(.f-basic)").hide();
          this.$editor.show();
          if (!(0 !== this.options.buttons.length)) {
            if (!this.options.editInPopup) {
              this.$editor.hide();
            }
          }
        } else {
          $(".froala-editor:not(.f-basic)").hide();
          this.$editor.show();
          this.repositionEditor();
        }
      }
      this.hidePopups();
      if (!this.options.editInPopup) {
        this.showEditPopupWrapper();
      }
      this.$bttn_wrapper.show();
      this.refreshButtons();
      /** @type {boolean} */
      this.imageMode = false;
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.hideDropdowns = function() {
    this.$bttn_wrapper.find(".fr-dropdown .fr-trigger").removeClass("active");
    this.$bttn_wrapper.find(".fr-dropdown .fr-trigger");
  };
  /**
   * @param {boolean} e
   * @return {?}
   */
  $.Editable.prototype.hide = function(e) {
    return this.initialized ? (void 0 === e && (e = true), e ? this.hideOtherEditors() : (this.closeImageMode(), this.imageMode = false), this.$popup_editor.hide(), this.hidePopups(false), void(this.link = false)) : false;
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.hideOtherEditors = function() {
    /** @type {number} */
    var count = 1;
    for (; count <= $.Editable.count; count++) {
      if (count != this._id) {
        this.$window.trigger("hide." + count);
      }
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.hideBttnWrapper = function() {
    if (this.options.inlineMode) {
      this.$bttn_wrapper.hide();
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.showBttnWrapper = function() {
    if (this.options.inlineMode) {
      this.$bttn_wrapper.show();
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.showEditPopupWrapper = function() {
    if (this.$edit_popup_wrapper) {
      this.$edit_popup_wrapper.show();
      setTimeout($.proxy(function() {
        this.$edit_popup_wrapper.find("input").val(this.$element.text()).focus().select();
      }, this), 1);
    }
  };
  /**
   * @param {boolean} recurring
   * @return {undefined}
   */
  $.Editable.prototype.hidePopups = function(recurring) {
    if (void 0 === recurring) {
      /** @type {boolean} */
      recurring = true;
    }
    if (recurring) {
      this.hideBttnWrapper();
    }
    this.raiseEvent("hidePopups");
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.showEditPopup = function() {
    this.showEditPopupWrapper();
  };
}(jQuery),
function($) {
  /**
   * @return {?}
   */
  $.Editable.prototype.getBoundingRect = function() {
    var me;
    if (this.isLink) {
      me = {};
      var $e = this.$element;
      /** @type {number} */
      me.left = $e.offset().left - this.$window.scrollLeft();
      /** @type {number} */
      me.top = $e.offset().top - this.$window.scrollTop();
      me.width = $e.outerWidth();
      me.height = parseInt($e.css("padding-top").replace("px", ""), 10) + $e.height();
      /** @type {number} */
      me.right = 1;
      /** @type {number} */
      me.bottom = 1;
      /** @type {boolean} */
      me.ok = true;
    } else {
      if (this.getRange() && this.getRange().collapsed) {
        var $h1 = $(this.getSelectionElement());
        this.saveSelectionByMarkers();
        var item = this.$element.find(".f-marker:first");
        item.css("display", "inline");
        var result = item.offset();
        item.css("display", "none");
        me = {};
        /** @type {number} */
        me.left = result.left - this.$window.scrollLeft();
        /** @type {number} */
        me.width = 0;
        /** @type {number} */
        me.height = (parseInt($h1.css("line-height").replace("px", ""), 10) || 10) - 10 - this.$window.scrollTop();
        me.top = result.top;
        /** @type {number} */
        me.right = 1;
        /** @type {number} */
        me.bottom = 1;
        /** @type {boolean} */
        me.ok = true;
        this.removeMarkers();
      } else {
        if (this.getRange()) {
          me = this.getRange().getBoundingClientRect();
        }
      }
    }
    return me;
  };
  /**
   * @param {boolean} threshold
   * @return {undefined}
   */
  $.Editable.prototype.repositionEditor = function(threshold) {
    var clientRect;
    var ll;
    var udataCur;
    if (this.options.inlineMode || threshold) {
      if (clientRect = this.getBoundingRect(), this.showBttnWrapper(), clientRect.ok || clientRect.left >= 0 && (clientRect.top >= 0 && (clientRect.right > 0 && clientRect.bottom > 0))) {
        ll = clientRect.left + clientRect.width / 2;
        udataCur = clientRect.top + clientRect.height;
        if (!(this.iOS() && this.iOSVersion() < 8)) {
          ll += this.$window.scrollLeft();
          udataCur += this.$window.scrollTop();
        }
        this.showByCoordinates(ll, udataCur);
      } else {
        if (this.options.alwaysVisible) {
          this.hide();
        } else {
          var otherElementRect = this.$element.offset();
          this.showByCoordinates(otherElementRect.left, otherElementRect.top + 10);
        }
      }
      if (0 === this.options.buttons.length) {
        this.hide();
      }
    }
  };
  /**
   * @param {number} x
   * @param {?} value
   * @return {undefined}
   */
  $.Editable.prototype.showByCoordinates = function(x, value) {
    x -= 22;
    value += 8;
    var $this = this.$document.find(this.options.scrollableContainer);
    if ("body" != this.options.scrollableContainer) {
      x -= $this.offset().left;
      value -= $this.offset().top;
      if (!this.iPad()) {
        x += $this.scrollLeft();
        value += $this.scrollTop();
      }
    }
    /** @type {number} */
    var radius = Math.max(this.$popup_editor.outerWidth(), 250);
    if (x + radius >= $this.outerWidth() - 50 && x + 44 - radius > 0) {
      this.$popup_editor.addClass("right-side");
      /** @type {number} */
      x = $this.outerWidth() - (x + 44);
      if ("static" == $this.css("position")) {
        /** @type {number} */
        x = x + parseFloat($this.css("margin-left"), 10) + parseFloat($this.css("margin-right"), 10);
      }
      this.$popup_editor.css("top", value);
      this.$popup_editor.css("right", x);
      this.$popup_editor.css("left", "auto");
    } else {
      if (x + radius < $this.outerWidth() - 50) {
        this.$popup_editor.removeClass("right-side");
        this.$popup_editor.css("top", value);
        this.$popup_editor.css("left", x);
        this.$popup_editor.css("right", "auto");
      } else {
        this.$popup_editor.removeClass("right-side");
        this.$popup_editor.css("top", value);
        this.$popup_editor.css("left", Math.max($this.outerWidth() - radius, 10) / 2);
        this.$popup_editor.css("right", "auto");
      }
    }
    this.$popup_editor.show();
  };
  /**
   * @param {string} command
   * @return {undefined}
   */
  $.Editable.prototype.positionPopup = function(command) {
    if ($(this.$editor.find('button.fr-bttn[data-cmd="' + command + '"]')).length) {
      var env = this.$editor.find('button.fr-bttn[data-cmd="' + command + '"]');
      var objectWidth = env.width();
      var nub_height = env.height();
      var ll = env.offset().left + objectWidth / 2;
      var udataCur = env.offset().top + nub_height;
      this.showByCoordinates(ll, udataCur);
    }
  };
}(jQuery),
function($) {
  /**
   * @param {Object} $slide
   * @return {undefined}
   */
  $.Editable.prototype.refreshImageAlign = function($slide) {
    this.$image_editor.find('.fr-dropdown > button[data-name="align"] + ul li').removeClass("active");
    /** @type {string} */
    var floatImageNone = "floatImageNone";
    /** @type {string} */
    var align = "center";
    if ($slide.hasClass("fr-fil")) {
      /** @type {string} */
      align = "left";
      /** @type {string} */
      floatImageNone = "floatImageLeft";
    } else {
      if ($slide.hasClass("fr-fir")) {
        /** @type {string} */
        align = "right";
        /** @type {string} */
        floatImageNone = "floatImageRight";
      }
    }
    this.$image_editor.find('.fr-dropdown > button[data-name="align"].fr-trigger i').attr("class", "fa fa-align-" + align);
    this.$image_editor.find('.fr-dropdown > button[data-name="align"] + ul li[data-val="' + floatImageNone + '"]').addClass("active");
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.refreshImageDisplay = function() {
    var divSpan = this.$element.find(".f-img-editor");
    this.$image_editor.find('.fr-dropdown > button[data-name="display"] + ul li').removeClass("active");
    if (divSpan.hasClass("fr-dib")) {
      this.$image_editor.find('.fr-dropdown > button[data-name="display"] + ul li[data-val="fr-dib"]').addClass("active");
    } else {
      this.$image_editor.find('.fr-dropdown > button[data-name="display"] + ul li[data-val="fr-dii"]').addClass("active");
    }
  };
  $.Editable.image_commands = {
    align: {
      title: "Alignment",
      icon: "fa fa-align-center",
      /** @type {function (Object): undefined} */
      refresh: $.Editable.prototype.refreshImageAlign,
      /** @type {function (Object): undefined} */
      refreshOnShow: $.Editable.prototype.refreshImageAlign,
      seed: [{
        cmd: "floatImageLeft",
        title: "Align Left",
        icon: "fa fa-align-left"
      }, {
        cmd: "floatImageNone",
        title: "Align Center",
        icon: "fa fa-align-center"
      }, {
        cmd: "floatImageRight",
        title: "Align Right",
        icon: "fa fa-align-right"
      }],
      /**
       * @param {?} resp
       * @param {?} __
       * @param {?} method
       * @return {undefined}
       */
      callback: function(resp, __, method) {
        this[method](resp);
      },
      undo: true
    },
    display: {
      title: "Text Wrap",
      icon: "fa fa-star",
      /** @type {function (): undefined} */
      refreshOnShow: $.Editable.prototype.refreshImageDisplay,
      namespace: "Image",
      seed: [{
        title: "Inline",
        value: "fr-dii"
      }, {
        title: "Break Text",
        value: "fr-dib"
      }],
      /**
       * @param {Object} label
       * @param {?} __
       * @param {?} deepDataAndEvents
       * @return {undefined}
       */
      callback: function(label, __, deepDataAndEvents) {
        this.displayImage(label, deepDataAndEvents);
      },
      undo: true
    },
    linkImage: {
      title: "Insert Link",
      icon: {
        type: "font",
        value: "fa fa-link"
      },
      /**
       * @param {Object} deepDataAndEvents
       * @return {undefined}
       */
      callback: function(deepDataAndEvents) {
        this.linkImage(deepDataAndEvents);
      }
    },
    replaceImage: {
      title: "Replace Image",
      icon: {
        type: "font",
        value: "fa fa-exchange"
      },
      /**
       * @param {Object} success
       * @return {undefined}
       */
      callback: function(success) {
        this.replaceImage(success);
      }
    },
    removeImage: {
      title: "Remove Image",
      icon: {
        type: "font",
        value: "fa fa-trash-o"
      },
      /**
       * @param {Object} bench
       * @return {undefined}
       */
      callback: function(bench) {
        this.removeImage(bench);
      }
    }
  };
  $.Editable.DEFAULTS = $.extend($.Editable.DEFAULTS, {
    allowedImageTypes: ["jpeg", "jpg", "png", "gif"],
    customImageButtons: {},
    defaultImageTitle: "Image title",
    defaultImageWidth: 300,
    defaultImageDisplay: "block",
    defaultImageAlignment: "center",
    imageButtons: ["display", "align", "linkImage", "replaceImage", "removeImage"],
    imageDeleteConfirmation: true,
    imageDeleteURL: null,
    imageDeleteParams: {},
    imageMove: true,
    imageResize: true,
    imageLink: true,
    imageTitle: true,
    imageUpload: true,
    imageUploadParams: {},
    imageUploadParam: "file",
    imageUploadToS3: false,
    imageUploadURL: "/",
    maxImageSize: 10485760,
    pasteImage: true,
    textNearImage: true
  });
  /**
   * @return {undefined}
   */
  $.Editable.prototype.hideImageEditorPopup = function() {
    if (this.$image_editor) {
      this.$image_editor.hide();
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.showImageEditorPopup = function() {
    if (this.$image_editor) {
      this.$image_editor.show();
    }
    if (!this.options.imageMove) {
      this.$element.attr("contenteditable", false);
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.showImageWrapper = function() {
    if (this.$image_wrapper) {
      this.$image_wrapper.show();
    }
  };
  /**
   * @param {boolean} dataAndEvents
   * @return {undefined}
   */
  $.Editable.prototype.hideImageWrapper = function(dataAndEvents) {
    if (this.$image_wrapper) {
      if (!this.$element.attr("data-resize")) {
        if (!dataAndEvents) {
          this.closeImageMode();
          /** @type {boolean} */
          this.imageMode = false;
        }
      }
      this.$image_wrapper.hide();
      this.$image_wrapper.find("input").blur();
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.showInsertImage = function() {
    this.hidePopups();
    this.showImageWrapper();
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.showImageEditor = function() {
    this.hidePopups();
    this.showImageEditorPopup();
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.insertImageHTML = function() {
    /** @type {string} */
    var b = '<div class="froala-popup froala-image-popup" style="display: none;"><h4><span data-text="true">Insert Image</span><span data-text="true">Uploading image</span><i title="Cancel" class="fa fa-times" id="f-image-close-' + this._id + '"></i></h4>';
    return b += '<div id="f-image-list-' + this._id + '">', this.options.imageUpload && (b += '<div class="f-popup-line drop-upload">', b += '<div class="f-upload" id="f-upload-div-' + this._id + '"><strong data-text="true">Drop Image</strong><br>(<span data-text="true">or click</span>)<form target="frame-' + this._id + '" enctype="multipart/form-data" encoding="multipart/form-data" action="' + this.options.imageUploadURL + '" method="post" id="f-upload-form-' + this._id + '"><input id="f-file-upload-' +
      this._id + '" type="file" name="' + this.options.imageUploadParam + '" accept="image/*"></form></div>', this.browser.msie && ($.Editable.getIEversion() <= 9 && (b += '<iframe id="frame-' + this._id + '" name="frame-' + this._id + '" src="javascript:false;" style="width:0; height:0; border:0px solid #FFF; position: fixed; z-index: -1;"></iframe>')), b += "</div>"), this.options.imageLink && (b += '<div class="f-popup-line"><label><span data-text="true">Enter URL</span>: </label><input id="f-image-url-' +
      this._id + '" type="text" placeholder="http://example.com"><button class="f-browse fr-p-bttn" id="f-browser-' + this._id + '"><i class="fa fa-search"></i></button><button data-text="true" class="f-ok fr-p-bttn f-submit" id="f-image-ok-' + this._id + '">OK</button></div>'), b += "</div>", b += '<p class="f-progress" id="f-progress-' + this._id + '"><span></span></p>', b += "</div>";
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.iFrameLoad = function() {
    var script = this.$image_wrapper.find("iframe#frame-" + this._id);
    if (!script.attr("data-loaded")) {
      return script.attr("data-loaded", true), false;
    }
    try {
      var $e = this.$image_wrapper.find("#f-upload-form-" + this._id);
      if (this.options.imageUploadToS3) {
        var a = $e.attr("action");
        var b = $e.find('input[name="key"]').val();
        var memory = a + b;
        this.writeImage(memory);
        if (this.options.imageUploadToS3.callback) {
          this.options.imageUploadToS3.callback.call(this, memory, b);
        }
      } else {
        var udataCur = script.contents().text();
        this.parseImageResponse(udataCur);
      }
    } catch (g) {
      this.throwImageError(7);
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.initImage = function() {
    this.buildInsertImage();
    if (!this.isLink || this.isImage) {
      this.initImagePopup();
    }
    this.addListener("destroy", this.destroyImage);
  };
  $.Editable.initializers.push($.Editable.prototype.initImage);
  /**
   * @return {undefined}
   */
  $.Editable.prototype.destroyImage = function() {
    if (this.$image_editor) {
      this.$image_editor.html("").removeData().remove();
    }
    if (this.$image_wrapper) {
      this.$image_wrapper.html("").removeData().remove();
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.buildInsertImage = function() {
    this.$image_wrapper = $(this.insertImageHTML());
    this.$popup_editor.append(this.$image_wrapper);
    var self = this;
    if (this.$image_wrapper.on("mouseup touchend", $.proxy(function(event) {
        if (!this.isResizing()) {
          event.stopPropagation();
        }
      }, this)), this.addListener("hidePopups", $.proxy(function() {
        this.hideImageWrapper(true);
      }, this)), this.$progress_bar = this.$image_wrapper.find("p#f-progress-" + this._id), this.options.imageUpload) {
      if (this.browser.msie && $.Editable.getIEversion() <= 9) {
        var target = this.$image_wrapper.find("iframe").get(0);
        if (target.attachEvent) {
          target.attachEvent("onload", function() {
            self.iFrameLoad();
          });
        } else {
          /**
           * @return {undefined}
           */
          target.onload = function() {
            self.iFrameLoad();
          };
        }
      }
      this.$image_wrapper.on("change", 'input[type="file"]', function() {
        if (void 0 !== this.files) {
          self.uploadImage(this.files);
        } else {
          if (!self.triggerEvent("beforeImageUpload", [], false)) {
            return false;
          }
          var element = $(this).parents("form");
          element.find('input[type="hidden"]').remove();
          var pkey;
          for (pkey in self.options.imageUploadParams) {
            element.prepend('<input type="hidden" name="' + pkey + '" value="' + self.options.imageUploadParams[pkey] + '" />');
          }
          if (self.options.imageUploadToS3 !== false) {
            for (pkey in self.options.imageUploadToS3.params) {
              element.prepend('<input type="hidden" name="' + pkey + '" value="' + self.options.imageUploadToS3.params[pkey] + '" />');
            }
            element.prepend('<input type="hidden" name="success_action_status" value="201" />');
            element.prepend('<input type="hidden" name="X-Requested-With" value="xhr" />');
            element.prepend('<input type="hidden" name="Content-Type" value="" />');
            element.prepend('<input type="hidden" name="key" value="' + self.options.imageUploadToS3.keyStart + (new Date).getTime() + "-" + $(this).val().match(/[^\/\\]+$/) + '" />');
          } else {
            element.prepend('<input type="hidden" name="XHR_CORS_TRARGETORIGIN" value="' + self.window.location.href + '" />');
          }
          self.showInsertImage();
          self.showImageLoader(true);
          self.disable();
          element.submit();
        }
        $(this).val("");
      });
    }
    this.buildDragUpload();
    this.$image_wrapper.on("mouseup keydown", "#f-image-url-" + this._id, $.proxy(function(e) {
      var b = e.which;
      if (!(b && 27 === b)) {
        e.stopPropagation();
      }
    }, this));
    this.$image_wrapper.on("click", "#f-image-ok-" + this._id, $.proxy(function() {
      this.writeImage(this.$image_wrapper.find("#f-image-url-" + this._id).val(), true);
    }, this));
    this.$image_wrapper.on(this.mouseup, "#f-image-close-" + this._id, $.proxy(function(event) {
      return this.isDisabled ? false : (event.stopPropagation(), this.$bttn_wrapper.show(), this.hideImageWrapper(true), this.options.inlineMode && (0 === this.options.buttons.length && (this.imageMode ? this.showImageEditor() : this.hide())), this.imageMode || (this.restoreSelection(), this.focus()), void(this.options.inlineMode || this.imageMode ? this.imageMode && this.showImageEditor() : this.hide()));
    }, this));
    this.$image_wrapper.on("click", function(event) {
      event.stopPropagation();
    });
    this.$image_wrapper.on("click", "*", function(event) {
      event.stopPropagation();
    });
  };
  /**
   * @param {Object} image
   * @return {undefined}
   */
  $.Editable.prototype.deleteImage = function(image) {
    if (this.options.imageDeleteURL) {
      var r = this.options.imageDeleteParams;
      r.info = image.data("info");
      r.src = image.attr("src");
      $.ajax({
        type: "POST",
        url: this.options.imageDeleteURL,
        data: r,
        crossDomain: this.options.crossDomain,
        xhrFields: {
          withCredentials: this.options.withCredentials
        },
        headers: this.options.headers
      }).done($.proxy(function(mouseInfo) {
        if (image.parent().parent().hasClass("f-image-list")) {
          image.parent().remove();
        } else {
          image.parent().removeClass("f-img-deleting");
        }
        this.triggerEvent("imageDeleteSuccess", [mouseInfo], false);
      }, this)).fail($.proxy(function() {
        image.parent().removeClass("f-img-deleting");
        this.triggerEvent("imageDeleteError", ["Error during image delete."], false);
      }, this));
    } else {
      image.parent().removeClass("f-img-deleting");
      this.triggerEvent("imageDeleteError", ["Missing imageDeleteURL option."], false);
    }
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.imageHandle = function() {
    var that = this;
    var imageHandle = $('<span data-fr-verified="true">').addClass("f-img-handle").on({
      /**
       * @param {Event} event
       * @return {undefined}
       */
      movestart: function(event) {
        that.hide();
        that.$element.addClass("f-non-selectable").attr("contenteditable", false);
        that.$element.attr("data-resize", true);
        $(this).attr("data-start-x", event.startX);
        $(this).attr("data-start-y", event.startY);
      },
      /**
       * @param {Object} el
       * @return {undefined}
       */
      move: function(el) {
        var self = $(this);
        /** @type {number} */
        var padding_delta = el.pageX - parseInt(self.attr("data-start-x"), 10);
        self.attr("data-start-x", el.pageX);
        self.attr("data-start-y", el.pageY);
        var $img = self.prevAll("img");
        var xpos = $img.width();
        if (self.hasClass("f-h-ne") || self.hasClass("f-h-se")) {
          $img.attr("width", xpos + padding_delta);
        } else {
          $img.attr("width", xpos - padding_delta);
        }
        that.triggerEvent("imageResize", [$img], false);
      },
      /**
       * @return {undefined}
       */
      moveend: function() {
        $(this).removeAttr("data-start-x");
        $(this).removeAttr("data-start-y");
        var $el = $(this);
        var currentSection = $el.prevAll("img");
        that.$element.removeClass("f-non-selectable");
        if (!that.isImage) {
          that.$element.attr("contenteditable", true);
        }
        that.triggerEvent("imageResizeEnd", [currentSection]);
        $(this).trigger("mouseup");
      },
      /**
       * @return {undefined}
       */
      touchend: function() {
        $(this).trigger("moveend");
      }
    });
    return imageHandle;
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.disableImageResize = function() {
    if (this.browser.mozilla) {
      try {
        document.execCommand("enableObjectResizing", false, false);
        document.execCommand("enableInlineTableEditing", false, false);
      } catch (a) {}
    }
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.isResizing = function() {
    return this.$element.attr("data-resize");
  };
  /**
   * @param {Object} $obj
   * @return {?}
   */
  $.Editable.prototype.getImageStyle = function($obj) {
    /** @type {string} */
    var b = "z-index: 1; position: relative; overflow: auto;";
    /** @type {Object} */
    var $this = $obj;
    /** @type {string} */
    var prefix = "padding";
    return $obj.parent().hasClass("f-img-editor") && ($this = $obj.parent(), prefix = "margin"), b += " padding-left:" + $this.css(prefix + "-left") + ";", b += " padding-right:" + $this.css(prefix + "-right") + ";", b += " padding-bottom:" + $this.css(prefix + "-bottom") + ";", b += " padding-top:" + $this.css(prefix + "-top") + ";", $obj.hasClass("fr-dib") ? (b += " vertical-align: top; display: block;", b += $obj.hasClass("fr-fir") ? " float: none; margin-right: 0; margin-left: auto;" : $obj.hasClass("fr-fil") ?
      " float: none; margin-left: 0; margin-right: auto;" : " float: none; margin: auto;") : (b += " display: inline-block;", b += $obj.hasClass("fr-fir") ? " float: right;" : $obj.hasClass("fr-fil") ? " float: left;" : " float: none;"), b;
  };
  /**
   * @param {string} pair
   * @return {?}
   */
  $.Editable.prototype.getImageClass = function(pair) {
    var excludes = pair.split(" ");
    return pair = "fr-fin", excludes.indexOf("fr-fir") >= 0 && (pair = "fr-fir"), excludes.indexOf("fr-fil") >= 0 && (pair = "fr-fil"), excludes.indexOf("fr-dib") >= 0 && (pair += " fr-dib"), excludes.indexOf("fr-dii") >= 0 && (pair += " fr-dii"), pair;
  };
  /**
   * @param {Object} child
   * @return {undefined}
   */
  $.Editable.prototype.refreshImageButtons = function(child) {
    this.$image_editor.find("button").removeClass("active");
    var f = child.css("float");
    /** @type {string} */
    f = child.hasClass("fr-fil") ? "Left" : child.hasClass("fr-fir") ? "Right" : "None";
    this.$image_editor.find('button[data-cmd="floatImage' + f + '"]').addClass("active");
    this.raiseEvent("refreshImage", [child]);
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.initImageEvents = function() {
    if (document.addEventListener) {
      if (!document.dropAssigned) {
        /** @type {boolean} */
        document.dropAssigned = true;
        document.addEventListener("drop", $.proxy(function(event) {
          return $(".froala-element img.fr-image-move").length ? (event.preventDefault(), event.stopPropagation(), $(".froala-element img.fr-image-move").removeClass("fr-image-move"), false) : void 0;
        }, this));
      }
    }
    this.disableImageResize();
    var self = this;
    this.$element.on("mousedown", 'img:not([contenteditable="false"])', function(event) {
      return self.isDisabled ? false : void(self.isResizing() || (self.initialized && event.stopPropagation(), self.$element.attr("contenteditable", false), $(this).addClass("fr-image-move")));
    });
    this.$element.on("mouseup", 'img:not([contenteditable="false"])', function() {
      return self.isDisabled ? false : void(self.isResizing() || (self.options.imageMove || (self.isImage || (self.isHTML || self.$element.attr("contenteditable", true))), $(this).removeClass("fr-image-move")));
    });
    this.$element.on("click touchend", 'img:not([contenteditable="false"])', function(event) {
      if (self.isDisabled) {
        return false;
      }
      if (!self.isResizing() && self.initialized) {
        if (event.preventDefault(), event.stopPropagation(), self.closeImageMode(), self.$element.blur(), self.refreshImageButtons($(this)), self.$image_editor.find('.f-image-alt input[type="text"]').val($(this).attr("alt") || $(this).attr("title")), self.showImageEditor(), !$(this).parent().hasClass("f-img-editor") || "SPAN" != $(this).parent().get(0).tagName) {
          var width = self.getImageClass($(this).attr("class"));
          $(this).wrap('<span data-fr-verified="true" class="f-img-editor ' + width + '"></span>');
          if (0 !== $(this).parents(".f-img-wrap").length || self.isImage) {
            $(this).parents(".f-img-wrap").attr("class", width + " f-img-wrap");
          } else {
            if ($(this).parents("a").length > 0) {
              $(this).parents("a:first").wrap('<span data-fr-verified="true" class="f-img-wrap ' + width + '"></span>');
            } else {
              $(this).parent().wrap('<span data-fr-verified="true" class="f-img-wrap ' + width + '"></span>');
            }
          }
        }
        if ($(this).parent().find(".f-img-handle").remove(), self.options.imageResize) {
          var record = self.imageHandle();
          $(this).parent().append(record.clone(true).addClass("f-h-ne"));
          $(this).parent().append(record.clone(true).addClass("f-h-se"));
          $(this).parent().append(record.clone(true).addClass("f-h-sw"));
          $(this).parent().append(record.clone(true).addClass("f-h-nw"));
        }
        self.showByCoordinates($(this).offset().left + $(this).width() / 2, $(this).offset().top + $(this).height());
        /** @type {boolean} */
        self.imageMode = true;
        self.$bttn_wrapper.find(".fr-bttn").removeClass("active");
        self.clearSelection();
      }
    });
    this.$element.on("mousedown touchstart", ".f-img-handle", $.proxy(function() {
      return self.isDisabled ? false : void this.$element.attr("data-resize", true);
    }, this));
    this.$element.on("mouseup", ".f-img-handle", $.proxy(function(ev) {
      if (self.isDisabled) {
        return false;
      }
      var inner = $(ev.target).prevAll("img");
      setTimeout($.proxy(function() {
        this.$element.removeAttr("data-resize");
        inner.click();
      }, this), 0);
    }, this));
  };
  /**
   * @param {?} index
   * @param {?} json
   * @param {?} error
   * @return {undefined}
   */
  $.Editable.prototype.execImage = function(index, json, error) {
    var visible_image = this.$element.find("span.f-img-editor");
    var t = visible_image.find("img");
    var data = $.Editable.image_commands[index] || this.options.customImageButtons[index];
    if (data) {
      if (data.callback) {
        data.callback.apply(this, [t, index, json, error]);
      }
    }
  };
  /**
   * @param {Object} data
   * @return {undefined}
   */
  $.Editable.prototype.bindImageRefreshListener = function(data) {
    if (data.refresh) {
      this.addListener("refreshImage", $.proxy(function(itemId) {
        data.refresh.apply(this, [itemId]);
      }, this));
    }
  };
  /**
   * @param {Object} stop
   * @param {string} index
   * @return {?}
   */
  $.Editable.prototype.buildImageButton = function(stop, index) {
    /** @type {string} */
    var c = '<button class="fr-bttn" data-namespace="Image" data-cmd="' + index + '" title="' + stop.title + '">';
    return c += void 0 !== this.options.icons[index] ? this.prepareIcon(this.options.icons[index], stop.title) : this.prepareIcon(stop.icon, stop.title), c += "</button>", this.bindImageRefreshListener(stop), c;
  };
  /**
   * @param {Object} data
   * @return {?}
   */
  $.Editable.prototype.buildImageAlignDropdown = function(data) {
    this.bindImageRefreshListener(data);
    /** @type {string} */
    var b = '<ul class="fr-dropdown-menu f-align">';
    /** @type {number} */
    var i = 0;
    for (; i < data.seed.length; i++) {
      var entry = data.seed[i];
      b += '<li data-cmd="align" data-namespace="Image" data-val="' + entry.cmd + '" title="' + entry.title + '"><a href="#"><i class="' + entry.icon + '"></i></a></li>';
    }
    return b += "</ul>";
  };
  /**
   * @param {Object} name
   * @return {?}
   */
  $.Editable.prototype.buildImageDropdown = function(name) {
    return dropdown = this.buildDefaultDropdown(name), btn = this.buildDropdownButton(name, dropdown), btn;
  };
  $.Editable.prototype.image_command_dispatcher = {
    /**
     * @param {Object} type
     * @return {?}
     */
    align: function(type) {
      var suiteView = this.buildImageAlignDropdown(type);
      var charset = this.buildDropdownButton(type, suiteView);
      return charset;
    }
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.buildImageButtons = function() {
    /** @type {string} */
    var optsData = "";
    /** @type {number} */
    var p = 0;
    for (; p < this.options.imageButtons.length; p++) {
      var type = this.options.imageButtons[p];
      if (void 0 !== $.Editable.image_commands[type] || void 0 !== this.options.customImageButtons[type]) {
        var item = $.Editable.image_commands[type] || this.options.customImageButtons[type];
        item.cmd = type;
        var self = this.image_command_dispatcher[type];
        optsData += self ? self.apply(this, [item]) : item.seed ? this.buildImageDropdown(item, type) : this.buildImageButton(item, type);
      }
    }
    return optsData;
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.initImagePopup = function() {
    this.$image_editor = $('<div class="froala-popup froala-image-editor-popup" style="display: none">');
    var stringBuffer = $('<div class="f-popup-line f-popup-toolbar">').appendTo(this.$image_editor);
    stringBuffer.append(this.buildImageButtons());
    this.addListener("hidePopups", this.hideImageEditorPopup);
    if (this.options.imageTitle) {
      $('<div class="f-popup-line f-image-alt">').append('<label><span data-text="true">Title</span>: </label>').append($('<input type="text">').on("mouseup keydown touchend", function(e) {
        var b = e.which;
        if (!(b && 27 === b)) {
          e.stopPropagation();
        }
      })).append('<button class="fr-p-bttn f-ok" data-text="true" data-callback="setImageAlt" data-cmd="setImageAlt" title="OK">OK</button>').appendTo(this.$image_editor);
    }
    this.$popup_editor.append(this.$image_editor);
    this.bindCommandEvents(this.$image_editor);
    this.bindDropdownEvents(this.$image_editor);
  };
  /**
   * @param {Object} container
   * @param {?} deepDataAndEvents
   * @return {undefined}
   */
  $.Editable.prototype.displayImage = function(container, deepDataAndEvents) {
    var listEntries = container.parents("span.f-img-editor");
    listEntries.removeClass("fr-dii fr-dib").addClass(deepDataAndEvents);
    this.triggerEvent("imageDisplayed", [container, deepDataAndEvents]);
    container.click();
  };
  /**
   * @param {Object} submit
   * @return {undefined}
   */
  $.Editable.prototype.floatImageLeft = function(submit) {
    var listEntries = submit.parents("span.f-img-editor");
    listEntries.removeClass("fr-fin fr-fil fr-fir").addClass("fr-fil");
    if (this.isImage) {
      this.$element.css("float", "left");
    }
    this.triggerEvent("imageFloatedLeft", [submit]);
    submit.click();
  };
  /**
   * @param {Object} submit
   * @return {undefined}
   */
  $.Editable.prototype.floatImageNone = function(submit) {
    var submenu = submit.parents("span.f-img-editor");
    submenu.removeClass("fr-fin fr-fil fr-fir").addClass("fr-fin");
    if (!this.isImage) {
      if (submenu.parent().get(0) == this.$element.get(0)) {
        submenu.wrap('<div style="text-align: center;"></div>');
      } else {
        submenu.parents(".f-img-wrap:first").css("text-align", "center");
      }
    }
    if (this.isImage) {
      this.$element.css("float", "none");
    }
    this.triggerEvent("imageFloatedNone", [submit]);
    submit.click();
  };
  /**
   * @param {Object} submit
   * @return {undefined}
   */
  $.Editable.prototype.floatImageRight = function(submit) {
    var listEntries = submit.parents("span.f-img-editor");
    listEntries.removeClass("fr-fin fr-fil fr-fir").addClass("fr-fir");
    if (this.isImage) {
      this.$element.css("float", "right");
    }
    this.triggerEvent("imageFloatedRight", [submit]);
    submit.click();
  };
  /**
   * @param {Object} deepDataAndEvents
   * @return {undefined}
   */
  $.Editable.prototype.linkImage = function(deepDataAndEvents) {
    /** @type {boolean} */
    this.imageMode = true;
    this.showInsertLink();
    var output = deepDataAndEvents.parents("span.f-img-editor");
    if ("A" == output.parent().get(0).tagName) {
      this.updateLinkValues(output.parent());
    } else {
      this.resetLinkValues();
    }
  };
  /**
   * @param {Object} element
   * @return {undefined}
   */
  $.Editable.prototype.replaceImage = function(element) {
    this.showInsertImage();
    /** @type {boolean} */
    this.imageMode = true;
    this.$image_wrapper.find('input[type="text"]').val(element.attr("src"));
    this.showByCoordinates(element.offset().left + element.width() / 2, element.offset().top + element.height());
  };
  /**
   * @param {Object} child
   * @return {?}
   */
  $.Editable.prototype.removeImage = function(child) {
    var $first = child.parents("span.f-img-editor");
    if (0 === $first.length) {
      return false;
    }
    var statsTemplate = child.get(0);
    /** @type {string} */
    var message = "Are you sure? Image will be deleted.";
    if ($.Editable.LANGS[this.options.language] && (message = $.Editable.LANGS[this.options.language].translation[message]), !this.options.imageDeleteConfirmation || confirm(message)) {
      if (this.triggerEvent("beforeRemoveImage", [$(statsTemplate)], false)) {
        var children = $first.parents(this.valid_nodes.join(","));
        if ($first.parents(".f-img-wrap").length) {
          $first.parents(".f-img-wrap").remove();
        } else {
          $first.remove();
        }
        this.refreshImageList(true);
        this.hide();
        if (children.length) {
          if (children[0] != this.$element.get(0)) {
            if ("" === $(children[0]).text()) {
              if (1 == children[0].childNodes.length) {
                $(children[0]).remove();
              }
            }
          }
        }
        this.wrapText();
        this.triggerEvent("afterRemoveImage", [child]);
        this.focus();
        /** @type {boolean} */
        this.imageMode = false;
      }
    } else {
      child.click();
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.setImageAlt = function() {
    var visible_image = this.$element.find("span.f-img-editor");
    var image = visible_image.find("img");
    image.attr("alt", this.$image_editor.find('.f-image-alt input[type="text"]').val());
    image.attr("title", this.$image_editor.find('.f-image-alt input[type="text"]').val());
    this.hide();
    this.closeImageMode();
    this.triggerEvent("imageAltSet", [image]);
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.buildImageMove = function() {
    var self = this;
    if (!this.isLink) {
      this.initDrag();
    }
    self.$element.on("dragover dragenter dragend", function(types) {
      types.preventDefault();
    });
    self.$element.on("drop", function(ev) {
      if (self.isDisabled) {
        return false;
      }
      if (self.closeImageMode(), self.hide(), self.imageMode = false, self.initialized || (self.$element.unbind("mousedown.element"), self.lateInit()), !self.options.imageUpload || 0 !== $(".froala-element img.fr-image-move").length) {
        if ($(".froala-element .fr-image-move").length > 0 && self.options.imageMove) {
          ev.preventDefault();
          ev.stopPropagation();
          self.insertMarkersAtPoint(ev.originalEvent);
          self.restoreSelectionByMarkers();
          var html = $("<div>").append($(".froala-element img.fr-image-move").clone().removeClass("fr-image-move").addClass("fr-image-dropped")).html();
          self.insertHTML(html);
          var elems = $(".froala-element img.fr-image-move").parent();
          $(".froala-element img.fr-image-move").remove();
          if (elems.get(0) != self.$element.get(0)) {
            if (elems.is(":empty")) {
              elems.remove();
            }
          }
          self.clearSelection();
          if (self.initialized) {
            setTimeout(function() {
              self.$element.find(".fr-image-dropped").removeClass(".fr-image-dropped").click();
            }, 0);
          } else {
            self.$element.find(".fr-image-dropped").removeClass(".fr-image-dropped");
          }
          self.sync();
          self.hideOtherEditors();
        } else {
          ev.preventDefault();
          ev.stopPropagation();
          $(".froala-element img.fr-image-move").removeClass("fr-image-move");
        }
        return false;
      }
      if (ev.originalEvent.dataTransfer && (ev.originalEvent.dataTransfer.files && ev.originalEvent.dataTransfer.files.length)) {
        if (self.isDisabled) {
          return false;
        }
        var files = ev.originalEvent.dataTransfer.files;
        if (self.options.allowedImageTypes.indexOf(files[0].type.replace(/image\//g, "")) >= 0) {
          self.insertMarkersAtPoint(ev.originalEvent);
          self.showByCoordinates(ev.originalEvent.pageX, ev.originalEvent.pageY);
          self.uploadImage(files);
          ev.preventDefault();
          ev.stopPropagation();
        }
      }
    });
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.buildDragUpload = function() {
    var $this = this;
    $this.$image_wrapper.on("dragover", "#f-upload-div-" + this._id, function() {
      return $(this).addClass("f-hover"), false;
    });
    $this.$image_wrapper.on("dragend", "#f-upload-div-" + this._id, function() {
      return $(this).removeClass("f-hover"), false;
    });
    $this.$image_wrapper.on("drop", "#f-upload-div-" + this._id, function(event) {
      return event.preventDefault(), event.stopPropagation(), $this.options.imageUpload ? ($(this).removeClass("f-hover"), void $this.uploadImage(event.originalEvent.dataTransfer.files)) : false;
    });
  };
  /**
   * @param {boolean} dataAndEvents
   * @return {undefined}
   */
  $.Editable.prototype.showImageLoader = function(dataAndEvents) {
    if (void 0 === dataAndEvents && (dataAndEvents = false), dataAndEvents) {
      /** @type {string} */
      var option = "Please wait!";
      if ($.Editable.LANGS[this.options.language]) {
        option = $.Editable.LANGS[this.options.language].translation[option];
      }
      this.$progress_bar.find("span").css("width", "100%").text(option);
    } else {
      this.$image_wrapper.find("h4").addClass("uploading");
    }
    this.$image_wrapper.find("#f-image-list-" + this._id).hide();
    this.$progress_bar.show();
    this.showInsertImage();
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.hideImageLoader = function() {
    this.$progress_bar.hide();
    this.$progress_bar.find("span").css("width", "0%").text("");
    this.$image_wrapper.find("#f-image-list-" + this._id).show();
    this.$image_wrapper.find("h4").removeClass("uploading");
  };
  /**
   * @param {boolean} data
   * @param {boolean} recurring
   * @param {?} deepDataAndEvents
   * @return {?}
   */
  $.Editable.prototype.writeImage = function(data, recurring, deepDataAndEvents) {
    if (recurring && (data = this.sanitizeURL(data), "" === data)) {
      return false;
    }
    /** @type {Image} */
    var img = new Image;
    img.onerror = $.proxy(function() {
      this.hideImageLoader();
      this.throwImageError(1);
    }, this);
    img.onload = this.imageMode ? $.proxy(function() {
      var clone = this.$element.find(".f-img-editor > img");
      clone.attr("src", data);
      this.hide();
      this.hideImageLoader();
      this.$image_editor.show();
      this.enable();
      this.triggerEvent("imageReplaced", [clone, deepDataAndEvents]);
      setTimeout(function() {
        clone.trigger("click");
      }, 0);
    }, this) : $.proxy(function() {
      this.insertLoadedImage(data, deepDataAndEvents);
    }, this);
    this.showImageLoader(true);
    /** @type {boolean} */
    img.src = data;
  };
  /**
   * @param {string} keepData
   * @param {boolean} recurring
   * @return {undefined}
   */
  $.Editable.prototype.processInsertImage = function(keepData, recurring) {
    if (void 0 === recurring) {
      /** @type {boolean} */
      recurring = true;
    }
    this.enable();
    this.focus();
    this.restoreSelection();
    /** @type {string} */
    var optsData = "";
    if (parseInt(this.options.defaultImageWidth, 10)) {
      /** @type {string} */
      optsData = ' width="' + this.options.defaultImageWidth + '"';
    }
    /** @type {string} */
    var fr_fin = "fr-fin";
    if ("left" == this.options.defaultImageAlignment) {
      /** @type {string} */
      fr_fin = "fr-fil";
    }
    if ("right" == this.options.defaultImageAlignment) {
      /** @type {string} */
      fr_fin = "fr-fir";
    }
    fr_fin += " fr-di" + this.options.defaultImageDisplay[0];
    /** @type {string} */
    var statsTemplate = '<img class="' + fr_fin + ' fr-just-inserted" alt="' + this.options.defaultImageTitle + '" src="' + keepData + '"' + optsData + ">";
    var div = this.getSelectionElements()[0];
    var rng = this.getRange();
    var context = !this.browser.msie && $.Editable.getIEversion() > 8 ? $(rng.startContainer) : null;
    if (context && context.hasClass("f-img-wrap")) {
      if (1 === rng.startOffset) {
        context.after("<" + this.options.defaultTag + '><span class="f-marker" data-type="true" data-id="0"></span><br/><span class="f-marker" data-type="false" data-id="0"></span></' + this.options.defaultTag + ">");
        this.restoreSelectionByMarkers();
        this.getSelection().collapseToStart();
      } else {
        if (0 === rng.startOffset) {
          context.before("<" + this.options.defaultTag + '><span class="f-marker" data-type="true" data-id="0"></span><br/><span class="f-marker" data-type="false" data-id="0"></span></' + this.options.defaultTag + ">");
          this.restoreSelectionByMarkers();
          this.getSelection().collapseToStart();
        }
      }
      this.insertHTML(statsTemplate);
    } else {
      if (this.getSelectionTextInfo(div).atStart && (div != this.$element.get(0) && ("TD" != div.tagName && ("TH" != div.tagName && "LI" != div.tagName)))) {
        $(div).before("<" + this.options.defaultTag + ">" + statsTemplate + "</" + this.options.defaultTag + ">");
      } else {
        this.insertHTML(statsTemplate);
      }
    }
    this.disable();
  };
  /**
   * @param {Object} name
   * @param {?} deepDataAndEvents
   * @return {undefined}
   */
  $.Editable.prototype.insertLoadedImage = function(name, deepDataAndEvents) {
    this.triggerEvent("imageLoaded", [name], false);
    this.processInsertImage(name, false);
    if (this.browser.msie) {
      this.$element.find("img").each(function(deepDataAndEvents, dataAndEvents) {
        /**
         * @return {?}
         */
        dataAndEvents.oncontrolselect = function() {
          return false;
        };
      });
    }
    this.enable();
    this.hide();
    this.hideImageLoader();
    this.wrapText();
    this.cleanupLists();
    var node;
    var parent = this.$element.find("img.fr-just-inserted").get(0);
    if (parent) {
      node = parent.previousSibling;
    }
    if (node) {
      if (3 == node.nodeType) {
        if (/\u200B/gi.test(node.textContent)) {
          $(node).remove();
        }
      }
    }
    this.triggerEvent("imageInserted", [this.$element.find("img.fr-just-inserted"), deepDataAndEvents]);
    setTimeout($.proxy(function() {
      this.$element.find("img.fr-just-inserted").removeClass("fr-just-inserted").trigger("touchend");
    }, this), 50);
  };
  /**
   * @param {string} output
   * @return {undefined}
   */
  $.Editable.prototype.throwImageErrorWithMessage = function(output) {
    this.enable();
    this.triggerEvent("imageError", [{
      message: output,
      code: 0
    }], false);
    this.hideImageLoader();
  };
  /**
   * @param {number} expectedNumberOfNonCommentArgs
   * @return {undefined}
   */
  $.Editable.prototype.throwImageError = function(expectedNumberOfNonCommentArgs) {
    this.enable();
    /** @type {string} */
    var output = "Unknown image upload error.";
    if (1 == expectedNumberOfNonCommentArgs) {
      /** @type {string} */
      output = "Bad link.";
    } else {
      if (2 == expectedNumberOfNonCommentArgs) {
        /** @type {string} */
        output = "No link in upload response.";
      } else {
        if (3 == expectedNumberOfNonCommentArgs) {
          /** @type {string} */
          output = "Error during file upload.";
        } else {
          if (4 == expectedNumberOfNonCommentArgs) {
            /** @type {string} */
            output = "Parsing response failed.";
          } else {
            if (5 == expectedNumberOfNonCommentArgs) {
              /** @type {string} */
              output = "Image too large.";
            } else {
              if (6 == expectedNumberOfNonCommentArgs) {
                /** @type {string} */
                output = "Invalid image type.";
              } else {
                if (7 == expectedNumberOfNonCommentArgs) {
                  /** @type {string} */
                  output = "Image can be uploaded only to same domain in IE 8 and IE 9.";
                }
              }
            }
          }
        }
      }
    }
    this.triggerEvent("imageError", [{
      code: expectedNumberOfNonCommentArgs,
      message: output
    }], false);
    this.hideImageLoader();
  };
  /**
   * @param {Array} data
   * @return {?}
   */
  $.Editable.prototype.uploadImage = function(data) {
    if (!this.triggerEvent("beforeImageUpload", [data], false)) {
      return false;
    }
    if (void 0 !== data && data.length > 0) {
      var req;
      if (this.drag_support.formdata && (req = this.drag_support.formdata ? new FormData : null), req) {
        var k;
        for (k in this.options.imageUploadParams) {
          req.append(k, this.options.imageUploadParams[k]);
        }
        if (this.options.imageUploadToS3 !== false) {
          for (k in this.options.imageUploadToS3.params) {
            req.append(k, this.options.imageUploadToS3.params[k]);
          }
          req.append("success_action_status", "201");
          req.append("X-Requested-With", "xhr");
          req.append("Content-Type", data[0].type);
          req.append("key", this.options.imageUploadToS3.keyStart + (new Date).getTime() + "-" + data[0].name);
        }
        if (req.append(this.options.imageUploadParam, data[0]), data[0].size > this.options.maxImageSize) {
          return this.throwImageError(5), false;
        }
        if (this.options.allowedImageTypes.indexOf(data[0].type.replace(/image\//g, "")) < 0) {
          return this.throwImageError(6), false;
        }
      }
      if (req) {
        var xhr;
        if (this.options.crossDomain) {
          xhr = this.createCORSRequest("POST", this.options.imageUploadURL);
        } else {
          /** @type {XMLHttpRequest} */
          xhr = new XMLHttpRequest;
          xhr.open("POST", this.options.imageUploadURL);
          var p;
          for (p in this.options.headers) {
            xhr.setRequestHeader(p, this.options.headers[p]);
          }
        }
        xhr.onload = $.proxy(function() {
          /** @type {string} */
          var option = "Please wait!";
          if ($.Editable.LANGS[this.options.language]) {
            option = $.Editable.LANGS[this.options.language].translation[option];
          }
          this.$progress_bar.find("span").css("width", "100%").text(option);
          try {
            if (this.options.imageUploadToS3) {
              if (201 == xhr.status) {
                this.parseImageResponseXML(xhr.responseXML);
              } else {
                this.throwImageError(3);
              }
            } else {
              if (xhr.status >= 200 && xhr.status < 300) {
                this.parseImageResponse(xhr.responseText);
              } else {
                try {
                  var $log = $.parseJSON(xhr.responseText);
                  if ($log.error) {
                    this.throwImageErrorWithMessage($log.error);
                  } else {
                    this.throwImageError(3);
                  }
                } catch (d) {
                  this.throwImageError(3);
                }
              }
            }
          } catch (d) {
            this.throwImageError(4);
          }
        }, this);
        xhr.onerror = $.proxy(function() {
          this.throwImageError(3);
        }, this);
        xhr.upload.onprogress = $.proxy(function(e) {
          if (e.lengthComputable) {
            /** @type {number} */
            var top = e.loaded / e.total * 100 | 0;
            this.$progress_bar.find("span").css("width", top + "%");
          }
        }, this);
        this.disable();
        xhr.send(req);
        this.showImageLoader();
      }
    }
  };
  /**
   * @param {?} value
   * @return {?}
   */
  $.Editable.prototype.parseImageResponse = function(value) {
    try {
      if (!this.triggerEvent("afterImageUpload", [value], false)) {
        return false;
      }
      var a = $.parseJSON(value);
      if (a.link) {
        this.writeImage(a.link, false, value);
      } else {
        if (a.error) {
          this.throwImageErrorWithMessage(a.error);
        } else {
          this.throwImageError(2);
        }
      }
    } catch (d) {
      this.throwImageError(4);
    }
  };
  /**
   * @param {?} sourceContainer
   * @return {undefined}
   */
  $.Editable.prototype.parseImageResponseXML = function(sourceContainer) {
    try {
      var memory = $(sourceContainer).find("Location").text();
      var fromIndex = $(sourceContainer).find("Key").text();
      if (this.options.imageUploadToS3.callback) {
        this.options.imageUploadToS3.callback.call(this, memory, fromIndex);
      }
      if (memory) {
        this.writeImage(memory);
      } else {
        this.throwImageError(2);
      }
    } catch (e) {
      this.throwImageError(4);
    }
  };
  /**
   * @param {string} array
   * @return {undefined}
   */
  $.Editable.prototype.setImageUploadURL = function(array) {
    if (array) {
      /** @type {string} */
      this.options.imageUploadURL = array;
    }
    if (this.options.imageUploadToS3) {
      /** @type {string} */
      // Fully disabled AmazonAWS -- don't need it.
      //this.options.imageUploadURL = "https://" + this.options.imageUploadToS3.bucket + "." + this.options.imageUploadToS3.region + ".amazonaws.com/";
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.closeImageMode = function() {
    this.$element.find("span.f-img-editor > img").each($.proxy(function(dataAndEvents, selector) {
      $(selector).removeClass("fr-fin fr-fil fr-fir fr-dib fr-dii").addClass(this.getImageClass($(selector).parent().attr("class")));
      if ($(selector).parents(".f-img-wrap").length > 0) {
        if ("A" == $(selector).parent().parent().get(0).tagName) {
          $(selector).siblings("span.f-img-handle").remove().end().unwrap().parent().unwrap();
        } else {
          $(selector).siblings("span.f-img-handle").remove().end().unwrap().unwrap();
        }
      } else {
        $(selector).siblings("span.f-img-handle").remove().end().unwrap();
      }
    }, this));
    if (this.$element.find("span.f-img-editor").length) {
      this.$element.find("span.f-img-editor").remove();
      this.$element.parents("span.f-img-editor").remove();
    }
    this.$element.removeClass("f-non-selectable");
    if (!this.editableDisabled) {
      if (!this.isHTML) {
        this.$element.attr("contenteditable", true);
      }
    }
    if (this.$image_editor) {
      this.$image_editor.hide();
    }
    if (this.$link_wrapper) {
      if (this.options.linkText) {
        this.$link_wrapper.find('input[type="text"].f-lt').parent().removeClass("fr-hidden");
      }
    }
  };
  /**
   * @param {number} dataAndEvents
   * @return {undefined}
   */
  $.Editable.prototype.refreshImageList = function(dataAndEvents) {
    if (!this.isLink && !this.options.editInPopup) {
      /** @type {Array} */
      var messages = [];
      /** @type {Array} */
      var flattened = [];
      var elem = this;
      if (this.$element.find("img").each(function(dataAndEvents, _element) {
          var element = $(_element);
          if (messages.push(element.attr("src")), flattened.push(element), "false" == element.attr("contenteditable")) {
            return true;
          }
          if (0 !== element.parents(".f-img-editor").length || (element.hasClass("fr-dii") || (element.hasClass("fr-dib") || (elem.options.textNearImage ? element.addClass(element.hasClass("fr-fin") ? "fr-dib" : element.hasClass("fr-fil") || element.hasClass("fr-fir") ? "fr-dii" : "block" == element.css("display") && "none" == element.css("float") ? "fr-dib" : "fr-dii") : (element.addClass("fr-dib"), elem.options.imageButtons.splice(elem.options.imageButtons.indexOf("display"), 1))))), elem.options.textNearImage ||
            element.removeClass("fr-dii").addClass("fr-dib"), 0 === element.parents(".f-img-editor").length && (!element.hasClass("fr-fil") && (!element.hasClass("fr-fir") && !element.hasClass("fr-fin")))) {
            if (element.hasClass("fr-dii")) {
              element.addClass("right" == element.css("float") ? "fr-fir" : "left" == element.css("float") ? "fr-fil" : "fr-fin");
            } else {
              var fr_fil = element.attr("style");
              element.hide();
              element.addClass(0 === parseInt(element.css("margin-right"), 10) && fr_fil ? "fr-fir" : 0 === parseInt(element.css("margin-left"), 10) && fr_fil ? "fr-fil" : "fr-fin");
              element.show();
            }
          }
          element.css("margin", "");
          element.css("float", "");
          element.css("display", "");
          element.removeAttr("data-style");
        }), void 0 === dataAndEvents) {
        /** @type {number} */
        var i = 0;
        for (; i < this.imageList.length; i++) {
          if (messages.indexOf(this.imageList[i].attr("src")) < 0) {
            this.triggerEvent("afterRemoveImage", [this.imageList[i]], false);
          }
        }
      }
      /** @type {Array} */
      this.imageList = flattened;
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.insertImage = function() {
    if (!this.options.inlineMode) {
      this.closeImageMode();
      /** @type {boolean} */
      this.imageMode = false;
      this.positionPopup("insertImage");
    }
    if (this.selectionInEditor()) {
      this.saveSelection();
    }
    this.showInsertImage();
    /** @type {boolean} */
    this.imageMode = false;
    this.$image_wrapper.find('input[type="text"]').val("");
  };
}(jQuery),
function($) {
  /**
   * @return {undefined}
   */
  $.Editable.prototype.showLinkWrapper = function() {
    if (this.$link_wrapper) {
      this.$link_wrapper.show();
      this.$link_wrapper.trigger("hideLinkList");
      this.$link_wrapper.trigger("hideLinkClassList");
      this.$link_wrapper.find("input.f-lu").removeClass("fr-error");
      if (this.imageMode || !this.options.linkText) {
        this.$link_wrapper.find('input[type="text"].f-lt').parent().addClass("fr-hidden");
      } else {
        this.$link_wrapper.find('input[type="text"].f-lt').parent().removeClass("fr-hidden");
      }
      if (this.imageMode) {
        this.$link_wrapper.find('input[type="text"].f-lu').removeAttr("disabled");
      }
      if (this.phone()) {
        this.$document.scrollTop(this.$link_wrapper.offset().top + 30);
      } else {
        setTimeout($.proxy(function() {
          if (!(this.imageMode && this.iPad())) {
            this.$link_wrapper.find('input[type="text"].f-lu').focus().select();
          }
        }, this), 0);
      }
      /** @type {boolean} */
      this.link = true;
    }
    this.refreshDisabledState();
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.hideLinkWrapper = function() {
    if (this.$link_wrapper) {
      this.$link_wrapper.hide();
      this.$link_wrapper.find("input").blur();
    }
    this.refreshDisabledState();
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.showInsertLink = function() {
    this.hidePopups();
    this.showLinkWrapper();
  };
  /**
   * @param {HTMLElement} $el
   * @return {undefined}
   */
  $.Editable.prototype.updateLinkValues = function($el) {
    var id = $el.attr("href") || "http://";
    this.$link_wrapper.find("input.f-lt").val($el.text());
    if (this.isLink) {
      if ("#" == id) {
        /** @type {string} */
        id = "";
      }
      this.$link_wrapper.find("input#f-lu-" + this._id).val(id.replace(/\&amp;/g, "&"));
      this.$link_wrapper.find(".f-external-link").attr("href", id || "#");
    } else {
      this.$link_wrapper.find("input.f-lu").val(id.replace(/\&amp;/g, "&"));
      this.$link_wrapper.find(".f-external-link").attr("href", id);
    }
    this.$link_wrapper.find("input.f-target").prop("checked", "_blank" == $el.attr("target"));
    this.$link_wrapper.find("li.f-choose-link-class").each($.proxy(function(dataAndEvents, elem) {
      if ($el.hasClass($(elem).data("class"))) {
        $(elem).click();
      }
    }, this));
    var key;
    for (key in this.options.linkAttributes) {
      var value = $el.attr(key);
      this.$link_wrapper.find("input.fl-" + key).val(value ? value : "");
    }
    this.$link_wrapper.find("a.f-external-link, button.f-unlink").show();
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.initLinkEvents = function() {
    var that = this;
    /**
     * @param {?} e
     * @return {undefined}
     */
    var prevent = function(e) {
      e.stopPropagation();
      e.preventDefault();
    };
    /**
     * @param {?} event
     * @return {?}
     */
    var handler = function(event) {
      return event.stopPropagation(), event.preventDefault(), that.isDisabled ? false : "" !== that.text() ? (that.hide(), false) : (that.link = true, that.clearSelection(), that.removeMarkers(), that.selectionDisabled || ($(this).before('<span class="f-marker" data-type="true" data-id="0" data-fr-verified="true"></span>'), $(this).after('<span class="f-marker" data-type="false" data-id="0" data-fr-verified="true"></span>'), that.restoreSelectionByMarkers()), that.exec("createLink"), that.updateLinkValues($(this)),
        that.showByCoordinates($(this).offset().left + $(this).outerWidth() / 2, $(this).offset().top + (parseInt($(this).css("padding-top"), 10) || 0) + $(this).height()), that.showInsertLink(), $(this).hasClass("fr-file") ? that.$link_wrapper.find("input.f-lu").attr("disabled", "disabled") : that.$link_wrapper.find("input.f-lu").removeAttr("disabled"), void that.closeImageMode());
    };
    this.$element.on("mousedown", "a", $.proxy(function(event) {
      if (!this.isResizing()) {
        event.stopPropagation();
      }
    }, this));
    if (this.isLink) {
      if (this.iOS()) {
        this.$element.on("touchstart", prevent);
        this.$element.on("touchend", handler);
      } else {
        this.$element.on("click", handler);
      }
    } else {
      if (this.iOS()) {
        this.$element.on("touchstart", 'a:not([contenteditable="false"])', prevent);
        this.$element.on("touchend", 'a:not([contenteditable="false"])', handler);
        this.$element.on("touchstart", 'a[contenteditable="false"]', prevent);
        this.$element.on("touchend", 'a[contenteditable="false"]', prevent);
      } else {
        this.$element.on("click", 'a:not([contenteditable="false"])', handler);
        this.$element.on("click", 'a[contenteditable="false"]', prevent);
      }
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.destroyLink = function() {
    this.$link_wrapper.html("").removeData().remove();
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.initLink = function() {
    this.buildCreateLink();
    this.initLinkEvents();
    this.addListener("destroy", this.destroyLink);
  };
  $.Editable.initializers.push($.Editable.prototype.initLink);
  /**
   * @return {undefined}
   */
  $.Editable.prototype.removeLink = function() {
    if (this.imageMode) {
      if ("A" == this.$element.find(".f-img-editor").parent().get(0).tagName) {
        $(this.$element.find(".f-img-editor").get(0)).unwrap();
      }
      this.triggerEvent("imageLinkRemoved");
      this.showImageEditor();
      this.$element.find(".f-img-editor").find("img").click();
      /** @type {boolean} */
      this.link = false;
    } else {
      this.restoreSelection();
      this.document.execCommand("unlink", false, null);
      if (!this.isLink) {
        this.$element.find("a:empty").remove();
      }
      this.triggerEvent("linkRemoved");
      this.hideLinkWrapper();
      this.$bttn_wrapper.show();
      if (!this.options.inlineMode || this.isLink) {
        this.hide();
      }
      /** @type {boolean} */
      this.link = false;
    }
  };
  /**
   * @param {string} value
   * @param {string} val
   * @param {string} elem
   * @param {boolean} dataAndEvents
   * @param {Object} attrs
   * @return {?}
   */
  $.Editable.prototype.writeLink = function(value, val, elem, dataAndEvents, attrs) {
    var codeSegments;
    var key = this.options.noFollow;
    if (this.options.alwaysBlank) {
      /** @type {boolean} */
      dataAndEvents = true;
    }
    var attr;
    /** @type {string} */
    var s = "";
    /** @type {string} */
    var optsData = "";
    /** @type {string} */
    var inner = "";
    if (key === true) {
      if (/^https?:\/\//.test(value)) {
        /** @type {string} */
        s = 'rel="nofollow"';
      }
    }
    if (dataAndEvents === true) {
      /** @type {string} */
      optsData = 'target="_blank"';
    }
    for (attr in attrs) {
      inner += " " + attr + '="' + attrs[attr] + '"';
    }
    /** @type {string} */
    var text = value;
    if (value = this.sanitizeURL(value), this.options.convertMailAddresses) {
      /** @type {RegExp} */
      var rchecked = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/i;
      if (rchecked.test(value)) {
        if (0 !== value.indexOf("mailto:")) {
          /** @type {string} */
          value = "mailto:" + value;
        }
      }
    }
    if (0 === value.indexOf("mailto:") || ("" === this.options.linkAutoPrefix || (/^(https?:|ftps?:|)\/\//.test(value) || (value = this.options.linkAutoPrefix + value))), "" === value) {
      return this.$link_wrapper.find("input.f-lu").addClass("fr-error").focus(), this.triggerEvent("badLink", [text], false), false;
    }
    if (this.$link_wrapper.find("input.f-lu").removeClass("fr-error"), this.imageMode) {
      if ("A" != this.$element.find(".f-img-editor").parent().get(0).tagName) {
        this.$element.find(".f-img-editor").wrap('<a data-fr-link="true" href="' + value + '" ' + optsData + " " + s + inner + "></a>");
      } else {
        var el = this.$element.find(".f-img-editor").parent();
        if (dataAndEvents === true) {
          el.attr("target", "_blank");
        } else {
          el.removeAttr("target");
        }
        if (key === true) {
          el.attr("rel", "nofollow");
        } else {
          el.removeAttr("rel");
        }
        for (attr in attrs) {
          if (attrs[attr]) {
            el.attr(attr, attrs[attr]);
          } else {
            el.removeAttr(attr);
          }
        }
        el.removeClass(Object.keys(this.options.linkClasses).join(" "));
        el.attr("href", value).addClass(elem);
      }
      this.triggerEvent("imageLinkInserted", [value]);
      this.showImageEditor();
      this.$element.find(".f-img-editor").find("img").click();
      /** @type {boolean} */
      this.link = false;
    } else {
      /** @type {null} */
      var context = null;
      if (this.isLink) {
        if ("" === val) {
          val = this.$element.text();
        }
      } else {
        this.restoreSelection();
        codeSegments = this.getSelectionLinks();
        if (codeSegments.length > 0) {
          context = codeSegments[0].attributes;
          is_file = $(codeSegments[0]).hasClass("fr-file");
        }
        this.saveSelectionByMarkers();
        this.document.execCommand("unlink", false, value);
        this.$element.find('span[data-fr-link="true"]').each(function(dataAndEvents, element) {
          $(element).replaceWith($(element).html());
        });
        this.restoreSelectionByMarkers();
      }
      if (this.isLink) {
        this.$element.text(val);
        /** @type {Array} */
        codeSegments = [this.$element.attr("href", value).get(0)];
      } else {
        this.removeMarkers();
        if (this.options.linkText || "" === this.text()) {
          this.insertHTML('<span class="f-marker" data-fr-verified="true" data-id="0" data-type="true"></span>' + (val || text /*this.clean(text)*/) + '<span class="f-marker" data-fr-verified="true" data-id="0" data-type="false"></span>');
          this.restoreSelectionByMarkers();
        }
        this.document.execCommand("createLink", false, value);
        codeSegments = this.getSelectionLinks();
      }
      /** @type {number} */
      var i = 0;
      for (; i < codeSegments.length; i++) {
        if (context) {
          /** @type {number} */
          var k = 0;
          for (; k < context.length; k++) {
            if ("href" != context[k].nodeName) {
              $(codeSegments[i]).attr(context[k].nodeName, context[k].value);
            }
          }
        }
        if (dataAndEvents === true) {
          $(codeSegments[i]).attr("target", "_blank");
        } else {
          $(codeSegments[i]).removeAttr("target");
        }
        if (key === true && /^https?:\/\//.test(value)) {
          $(codeSegments[i]).attr("rel", "nofollow");
        } else {
          $(codeSegments[i]).removeAttr("rel");
        }
        $(codeSegments[i]).data("fr-link", true);
        $(codeSegments[i]).removeClass(Object.keys(this.options.linkClasses).join(" "));
        $(codeSegments[i]).addClass(elem);
        for (attr in attrs) {
          if (attrs[attr]) {
            $(codeSegments[i]).attr(attr, attrs[attr]);
          } else {
            $(codeSegments[i]).removeAttr(attr);
          }
        }
      }
      this.$element.find("a:empty").remove();
      this.triggerEvent("linkInserted", [value]);
      this.hideLinkWrapper();
      this.$bttn_wrapper.show();
      if (!this.options.inlineMode || this.isLink) {
        this.hide();
      }
      /** @type {boolean} */
      this.link = false;
    }
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.createLinkHTML = function() {
    /** @type {string} */
    var a = '<div class="froala-popup froala-link-popup" style="display: none;">';
    a += '<h4><span data-text="true">Insert Link</span><a target="_blank" title="Open Link" class="f-external-link" href="#"><i class="fa fa-external-link"></i></a><i title="Cancel" class="fa fa-times" id="f-link-close-' + this._id + '"></i></h4>';
    a += '<div class="f-popup-line fr-hidden"><input type="text" placeholder="Text" class="f-lt" id="f-lt-' + this._id + '"></div>';
    /** @type {string} */
    var optsData = "";
    if (this.options.linkList.length && (optsData = "f-bi"), a += '<div class="f-popup-line"><input type="text" placeholder="http://www.example.com" class="f-lu ' + optsData + '" id="f-lu-' + this._id + '"/>', this.options.linkList.length) {
      a += '<button class="fr-p-bttn f-browse-links" id="f-browse-links-' + this._id + '"><i class="fa fa-chevron-down"></i></button>';
      a += '<ul id="f-link-list-' + this._id + '">';
      /** @type {number} */
      var w = 0;
      for (; w < this.options.linkList.length; w++) {
        var map = this.options.linkList[w];
        /** @type {string} */
        var urlConfigHtml = "";
        var letter;
        for (letter in map) {
          urlConfigHtml += " data-" + letter + '="' + map[letter] + '"';
        }
        a += '<li class="f-choose-link"' + urlConfigHtml + ">" + map.body + "</li>";
      }
      a += "</ul>";
    }
    if (a += "</div>", Object.keys(this.options.linkClasses).length) {
      a += '<div class="f-popup-line"><input type="text" placeholder="Choose link type" class="f-bi" id="f-luc-' + this._id + '" disabled="disabled"/>';
      a += '<button class="fr-p-bttn f-browse-links" id="f-links-class-' + this._id + '"><i class="fa fa-chevron-down"></i></button>';
      a += '<ul id="f-link-class-list-' + this._id + '">';
      var k;
      for (k in this.options.linkClasses) {
        var cs = this.options.linkClasses[k];
        a += '<li class="f-choose-link-class" data-class="' + k + '">' + cs + "</li>";
      }
      a += "</ul>";
      a += "</div>";
    }
    var p;
    for (p in this.options.linkAttributes) {
      var subdir = this.options.linkAttributes[p];
      a += '<div class="f-popup-line"><input class="fl-' + p + '" type="text" placeholder="' + subdir + '" id="fl-' + p + "-" + this._id + '"/></div>';
    }
    return a += '<div class="f-popup-line"><input type="checkbox" class="f-target" id="f-target-' + this._id + '"> <label data-text="true" for="f-target-' + this._id + '">Open in new tab</label><button data-text="true" type="button" class="fr-p-bttn f-ok f-submit" id="f-ok-' + this._id + '">OK</button>', this.options.unlinkButton && (a += '<button type="button" data-text="true" class="fr-p-bttn f-ok f-unlink" id="f-unlink-' + this._id + '">UNLINK</button>'), a += "</div></div>";
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.buildCreateLink = function() {
    this.$link_wrapper = $(this.createLinkHTML());
    this.$popup_editor.append(this.$link_wrapper);
    var self = this;
    this.addListener("hidePopups", this.hideLinkWrapper);
    this.$link_wrapper.on("mouseup touchend", $.proxy(function(event) {
      if (!this.isResizing()) {
        event.stopPropagation();
        this.$link_wrapper.trigger("hideLinkList");
      }
    }, this));
    this.$link_wrapper.on("click", function(event) {
      event.stopPropagation();
    });
    this.$link_wrapper.on("click", "*", function(event) {
      event.stopPropagation();
    });
    if (this.options.linkText) {
      this.$link_wrapper.on("mouseup keydown", "input#f-lt-" + this._id, $.proxy(function(e) {
        var b = e.which;
        if (!(b && 27 === b)) {
          e.stopPropagation();
        }
        this.$link_wrapper.trigger("hideLinkList");
        this.$link_wrapper.trigger("hideLinkClassList");
      }, this));
    }
    this.$link_wrapper.on("mouseup keydown touchend touchstart", "input#f-lu-" + this._id, $.proxy(function(e) {
      var b = e.which;
      if (!(b && 27 === b)) {
        e.stopPropagation();
      }
      this.$link_wrapper.trigger("hideLinkList");
      this.$link_wrapper.trigger("hideLinkClassList");
    }, this));
    this.$link_wrapper.on("click keydown", "input#f-target-" + this._id, function(e) {
      var b = e.which;
      if (!(b && 27 === b)) {
        e.stopPropagation();
      }
    });
    this.$link_wrapper.on("touchend", "button#f-ok-" + this._id, function(event) {
      event.stopPropagation();
    }).on("click", "button#f-ok-" + this._id, $.proxy(function() {
      var tr;
      var pos = this.$link_wrapper.find("input#f-lt-" + this._id);
      var inputEl = this.$link_wrapper.find("input#f-lu-" + this._id);
      var body = this.$link_wrapper.find("input#f-luc-" + this._id);
      var $input = this.$link_wrapper.find("input#f-target-" + this._id);
      tr = pos ? pos.val() : "";
      var val = inputEl.val();
      if (this.isLink) {
        if ("" === val) {
          /** @type {string} */
          val = "#";
        }
      }
      /** @type {string} */
      var later = "";
      if (body) {
        later = body.data("class");
      }
      var validObj = {};
      var key;
      for (key in this.options.linkAttributes) {
        validObj[key] = this.$link_wrapper.find("input#fl-" + key + "-" + this._id).val();
      }
      this.writeLink(val, tr, later, $input.prop("checked"), validObj);
    }, this));
    this.$link_wrapper.on("click touch", "button#f-unlink-" + this._id, $.proxy(function() {
      /** @type {boolean} */
      this.link = true;
      this.removeLink();
    }, this));
    if (this.options.linkList.length) {
      this.$link_wrapper.on("click touch", "li.f-choose-link", function() {
        self.resetLinkValues();
        var $button = self.$link_wrapper.find("button#f-browse-links-" + self._id);
        var el = self.$link_wrapper.find("input#f-lt-" + self._id);
        var urlInput = self.$link_wrapper.find("input#f-lu-" + self._id);
        var $input = self.$link_wrapper.find("input#f-target-" + self._id);
        if (el) {
          el.val($(this).data("body"));
        }
        urlInput.val($(this).data("href"));
        $input.prop("checked", $(this).data("blank"));
        var data;
        for (data in self.options.linkAttributes) {
          if ($(this).data(data)) {
            self.$link_wrapper.find("input#fl-" + data + "-" + self._id).val($(this).data(data));
          }
        }
        $button.click();
      }).on("mouseup", "li.f-choose-link", function(event) {
        event.stopPropagation();
      });
      this.$link_wrapper.on("click", "button#f-browse-links-" + this._id + ", button#f-browse-links-" + this._id + " > i", function(event) {
        event.stopPropagation();
        var x = self.$link_wrapper.find("ul#f-link-list-" + self._id);
        self.$link_wrapper.trigger("hideLinkClassList");
        $(this).find("i").toggleClass("fa-chevron-down");
        $(this).find("i").toggleClass("fa-chevron-up");
        x.toggle();
      }).on("mouseup", "button#f-browse-links-" + this._id + ", button#f-browse-links-" + this._id + " > i", function(event) {
        event.stopPropagation();
      });
      this.$link_wrapper.bind("hideLinkList", function() {
        var revisionCheckbox = self.$link_wrapper.find("ul#f-link-list-" + self._id);
        var $button = self.$link_wrapper.find("button#f-browse-links-" + self._id);
        if (revisionCheckbox) {
          if (revisionCheckbox.is(":visible")) {
            $button.click();
          }
        }
      });
    }
    if (Object.keys(this.options.linkClasses).length) {
      this.$link_wrapper.on("mouseup keydown", "input#f-luc-" + this._id, $.proxy(function(e) {
        var b = e.which;
        if (!(b && 27 === b)) {
          e.stopPropagation();
        }
        this.$link_wrapper.trigger("hideLinkList");
        this.$link_wrapper.trigger("hideLinkClassList");
      }, this));
      this.$link_wrapper.on("click touch", "li.f-choose-link-class", function() {
        var input = self.$link_wrapper.find("input#f-luc-" + self._id);
        input.val($(this).text());
        input.data("class", $(this).data("class"));
        self.$link_wrapper.trigger("hideLinkClassList");
      }).on("mouseup", "li.f-choose-link-class", function(event) {
        event.stopPropagation();
      });
      this.$link_wrapper.on("click", "button#f-links-class-" + this._id, function(event) {
        event.stopPropagation();
        self.$link_wrapper.trigger("hideLinkList");
        var x = self.$link_wrapper.find("ul#f-link-class-list-" + self._id);
        $(this).find("i").toggleClass("fa-chevron-down");
        $(this).find("i").toggleClass("fa-chevron-up");
        x.toggle();
      }).on("mouseup", "button#f-links-class-" + this._id, function(event) {
        event.stopPropagation();
      });
      this.$link_wrapper.bind("hideLinkClassList", function() {
        var revisionCheckbox = self.$link_wrapper.find("ul#f-link-class-list-" + self._id);
        var $button = self.$link_wrapper.find("button#f-links-class-" + self._id);
        if (revisionCheckbox) {
          if (revisionCheckbox.is(":visible")) {
            $button.click();
          }
        }
      });
    }
    this.$link_wrapper.on(this.mouseup, "i#f-link-close-" + this._id, $.proxy(function() {
      this.$bttn_wrapper.show();
      this.hideLinkWrapper();
      if (!this.options.inlineMode && !this.imageMode || (this.isLink || 0 === this.options.buttons.length)) {
        this.hide();
      }
      if (this.imageMode) {
        this.showImageEditor();
      } else {
        this.restoreSelection();
        this.focus();
      }
    }, this));
  };
  /**
   * @return {?}
   */
  $.Editable.prototype.getSelectionLinks = function() {
    var range;
    var node;
    var a;
    var r;
    /** @type {Array} */
    var results = [];
    if (this.window.getSelection) {
      var sel = this.window.getSelection();
      if (sel.getRangeAt && sel.rangeCount) {
        r = this.document.createRange();
        /** @type {number} */
        var ri = 0;
        for (; ri < sel.rangeCount; ++ri) {
          if (range = sel.getRangeAt(ri), node = range.commonAncestorContainer, node && (1 != node.nodeType && (node = node.parentNode)), node && "a" == node.nodeName.toLowerCase()) {
            results.push(node);
          } else {
            a = node.getElementsByTagName("a");
            /** @type {number} */
            var j = 0;
            for (; j < a.length; ++j) {
              r.selectNodeContents(a[j]);
              if (r.compareBoundaryPoints(range.END_TO_START, range) < 1) {
                if (r.compareBoundaryPoints(range.START_TO_END, range) > -1) {
                  results.push(a[j]);
                }
              }
            }
          }
        }
      }
    } else {
      if (this.document.selection && "Control" != this.document.selection.type) {
        if (range = this.document.selection.createRange(), node = range.parentElement(), "a" == node.nodeName.toLowerCase()) {
          results.push(node);
        } else {
          a = node.getElementsByTagName("a");
          r = this.document.body.createTextRange();
          /** @type {number} */
          var i = 0;
          for (; i < a.length; ++i) {
            r.moveToElementText(a[i]);
            if (r.compareEndPoints("StartToEnd", range) > -1) {
              if (r.compareEndPoints("EndToStart", range) < 1) {
                results.push(a[i]);
              }
            }
          }
        }
      }
    }
    return results;
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.resetLinkValues = function() {
    this.$link_wrapper.find("input").val("");
    this.$link_wrapper.find('input[type="checkbox"].f-target').prop("checked", this.options.alwaysBlank);
    this.$link_wrapper.find('input[type="text"].f-lt').val(this.text());
    this.$link_wrapper.find('input[type="text"].f-lu').val("http://");
    this.$link_wrapper.find('input[type="text"].f-lu').removeAttr("disabled");
    this.$link_wrapper.find("a.f-external-link, button.f-unlink").hide();
    var k;
    for (k in this.options.linkAttributes) {
      this.$link_wrapper.find('input[type="text"].fl-' + k).val("");
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.insertLink = function() {
    if (!this.options.inlineMode) {
      this.closeImageMode();
      /** @type {boolean} */
      this.imageMode = false;
      this.positionPopup("createLink");
    }
    if (this.selectionInEditor()) {
      this.saveSelection();
    }
    this.showInsertLink();
    var _queries = this.getSelectionLinks();
    if (_queries.length > 0) {
      this.updateLinkValues($(_queries[0]));
    } else {
      this.resetLinkValues();
    }
  };
}(jQuery),
function($) {
  /**
   * @return {undefined}
   */
  $.Editable.prototype.browserFixes = function() {
    this.backspaceEmpty();
    this.backspaceInEmptyBlock();
    this.fixHR();
    this.domInsert();
    this.fixIME();
    this.cleanInvisibleSpace();
    this.cleanBR();
    this.insertSpace();
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.backspaceInEmptyBlock = function() {
    this.$element.on("keyup", $.proxy(function(e) {
      var key = e.which;
      if (this.browser.mozilla && (!this.isHTML && 8 == key)) {
        var $el = $(this.getSelectionElement());
        if (this.valid_nodes.indexOf($el.get(0).tagName) >= 0) {
          if (1 == $el.find("*").length) {
            if ("" === $el.text()) {
              if (1 == $el.find("br").length) {
                this.setSelection($el.get(0));
              }
            }
          }
        }
      }
    }, this));
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.insertSpace = function() {
    if (this.browser.mozilla) {
      this.$element.on("keypress", $.proxy(function(e) {
        var key = e.which;
        var offsetParent = this.getSelectionElements()[0];
        if (!this.isHTML) {
          if (!(32 != key)) {
            if (!("PRE" == offsetParent.tagName)) {
              e.preventDefault();
              this.insertSimpleHTML("&nbsp;");
            }
          }
        }
      }, this));
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.cleanBR = function() {
    this.$element.on("keyup", $.proxy(function() {
      this.$element.find(this.valid_nodes.join(",")).each($.proxy(function(dataAndEvents, el) {
        if (["TH", "TD", "LI"].indexOf(el.tagName) >= 0) {
          return true;
        }
        var nodes = el.childNodes;
        /** @type {null} */
        var node = null;
        if (!nodes.length || "BR" != nodes[nodes.length - 1].tagName) {
          return true;
        }
        node = nodes[nodes.length - 1];
        var n = node.previousSibling;
        if (n) {
          if ("BR" != n.tagName) {
            if ($(node).parent().text().length > 0) {
              if (this.valid_nodes.indexOf(n.tagName) < 0) {
                $(node).remove();
              }
            }
          }
        }
      }, this));
    }, this));
  };
  /**
   * @param {Array} children
   * @return {undefined}
   */
  $.Editable.prototype.replaceU200B = function(children) {
    /** @type {number} */
    var i = 0;
    for (; i < children.length; i++) {
      if (3 == children[i].nodeType && /\u200B/gi.test(children[i].textContent)) {
        children[i].textContent = children[i].textContent.replace(/\u200B/gi, "");
      } else {
        if (1 == children[i].nodeType) {
          this.replaceU200B($(children[i]).contents());
        }
      }
    }
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.cleanInvisibleSpace = function() {
    /**
     * @param {boolean} id
     * @return {?}
     */
    var load = function(id) {
      var str32 = $(id).text();
      return id && (/\u200B/.test($(id).text()) && str32.replace(/\u200B/gi, "").length > 0) ? true : false;
    };
    this.$element.on("keyup", $.proxy(function() {
      var el = this.getSelectionElement();
      if (load(el)) {
        if (0 === $(el).find("li").length) {
          this.saveSelectionByMarkers();
          this.replaceU200B($(el).contents());
          this.restoreSelectionByMarkers();
        }
      }
    }, this));
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.fixHR = function() {
    this.$element.on("keypress", $.proxy(function(e) {
      var _this = $(this.getSelectionElement());
      if (_this.is("hr") || _this.parents("hr").length) {
        return false;
      }
      var key = e.which;
      if (8 == key) {
        var selected = $(this.getSelectionElements()[0]);
        if (selected.prev().is("hr")) {
          if (this.getSelectionTextInfo(selected.get(0)).atStart) {
            this.saveSelectionByMarkers();
            selected.prev().remove();
            this.restoreSelectionByMarkers();
            e.preventDefault();
          }
        }
      }
    }, this));
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.backspaceEmpty = function() {
    this.$element.on("keydown", $.proxy(function(e) {
      var key = e.which;
      if (!this.isHTML) {
        if (8 == key) {
          if (this.$element.hasClass("f-placeholder")) {
            e.preventDefault();
          }
        }
      }
    }, this));
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.domInsert = function() {
    this.$element.on("keydown", $.proxy(function(e) {
      var key = e.which;
      if (13 === key) {
        /** @type {boolean} */
        this.add_br = true;
      }
    }, this));
    this.$element.on("DOMNodeInserted", $.proxy(function(e) {
      if ("SPAN" !== e.target.tagName || ($(e.target).attr("data-fr-verified") || (this.no_verify || (this.textEmpty(e.target) || $(e.target).replaceWith($(e.target).contents())))), "BR" === e.target.tagName && setTimeout(function() {
          $(e.target).removeAttr("type");
        }, 0), "A" === e.target.tagName && setTimeout(function() {
          $(e.target).removeAttr("_moz_dirty");
        }, 0), this.options.paragraphy && (this.add_br && ("BR" === e.target.tagName && ($(e.target).prev().length && "TABLE" === $(e.target).prev().get(0).tagName || $(e.target).next().length && "TABLE" === $(e.target).next().get(0).tagName)))) {
        $(e.target).wrap('<p class="fr-p-wrap">');
        var cl = this.$element.find("p.fr-p-wrap").removeAttr("class");
        this.setSelection(cl.get(0));
      }
      if ("BR" === e.target.tagName) {
        if (this.isLastSibling(e.target)) {
          if ("LI" == e.target.parentNode.tagName) {
            if (this.textEmpty(e.target.parentNode)) {
              $(e.target).remove();
            }
          }
        }
      }
    }, this));
    this.$element.on("keyup", $.proxy(function(e) {
      var key = e.which;
      if (8 === key) {
        this.$element.find("span:not([data-fr-verified])").attr("data-fr-verified", true);
      }
      if (13 === key) {
        /** @type {boolean} */
        this.add_br = false;
      }
    }, this));
  };
  /**
   * @return {undefined}
   */
  $.Editable.prototype.fixIME = function() {
    try {
      if (this.$element.get(0).msGetInputContext) {
        this.$element.get(0).msGetInputContext().addEventListener("MSCandidateWindowShow", $.proxy(function() {
          /** @type {boolean} */
          this.ime = true;
        }, this));
        this.$element.get(0).msGetInputContext().addEventListener("MSCandidateWindowHide", $.proxy(function() {
          /** @type {boolean} */
          this.ime = false;
          this.$element.trigger("keydown");
          /** @type {string} */
          this.oldHTML = "";
        }, this));
      }
    } catch (b) {}
  };
}(jQuery),
function($) {
  /**
   * @return {undefined}
   */
  $.Editable.prototype.handleEnter = function() {
    var throttledUpdate = $.proxy(function() {
      var offsetParent = this.getSelectionElement();
      return "LI" == offsetParent.tagName || this.parents($(offsetParent), "li").length > 0 ? true : false;
    }, this);
    this.$element.on("keypress", $.proxy(function(e) {
      if (!this.isHTML && !throttledUpdate()) {
        var key = e.which;
        if (13 == key && !e.shiftKey) {
          e.preventDefault();
          this.saveUndoStep();
          this.insertSimpleHTML("<break></break>");
          var enterInMainElement = this.getSelectionElements();
          if (enterInMainElement[0] == this.$element.get(0) ? this.enterInMainElement(enterInMainElement[0]) : this.enterInElement(enterInMainElement[0]), this.getSelectionTextInfo(this.$element.get(0)).atEnd) {
            this.$wrapper.scrollTop(this.$element.height());
          } else {
            var boundingRect = this.getBoundingRect();
            if (this.$wrapper.offset().top + this.$wrapper.height() < boundingRect.top + boundingRect.height) {
              this.$wrapper.scrollTop(boundingRect.top + this.$wrapper.scrollTop() - (this.$wrapper.height() + this.$wrapper.offset().top) + boundingRect.height + 10);
            }
          }
        }
      }
    }, this));
  };
  /**
   * @param {Node} el
   * @return {undefined}
   */
  $.Editable.prototype.enterInMainElement = function(el) {
    var element = $(el).find("break").get(0);
    if ($(element).parent().get(0) == el) {
      if (this.isLastSibling(element)) {
        this.insertSimpleHTML("</br>" + this.markers_html + this.br);
      } else {
        if ($(el).hasClass("f-placeholder")) {
          $(el).html("</br>" + this.markers_html + this.br);
        } else {
          this.insertSimpleHTML("</br>" + this.markers_html);
        }
      }
      $(el).find("break").remove();
      this.restoreSelectionByMarkers();
    } else {
      if ($(element).parents(this.$element).length) {
        el = this.getSelectionElement();
        for (;
          "BREAK" == el.tagName || 0 === $(el).text().length && el.parentNode != this.$element.get(0);) {
          el = el.parentNode;
        }
        if (this.getSelectionTextInfo(el).atEnd) {
          $(el).after(this.breakEnd(this.getDeepParent(el), true));
          this.$element.find("break").remove();
          this.restoreSelectionByMarkers();
        } else {
          if (this.getSelectionTextInfo(el).atStart) {
            for (; element.parentNode != this.$element.get(0);) {
              element = element.parentNode;
            }
            $(element).before("<br/>");
            this.$element.find("break").remove();
            this.$element.find("a:empty").replaceWith(this.markers_html + "<br/>");
            this.restoreSelectionByMarkers();
          } else {
            this.breakMiddle(this.getDeepParent(el), true);
            this.restoreSelectionByMarkers();
          }
        }
      } else {
        $(element).remove();
      }
    }
  };
  /**
   * @param {Node} current
   * @return {undefined}
   */
  $.Editable.prototype.enterInElement = function(current) {
    if (["TD", "TH"].indexOf(current.tagName) < 0) {
      /** @type {boolean} */
      var udataCur = false;
      if (this.emptyElement(current) && (current.parentNode && "BLOCKQUOTE" == current.parentNode.tagName)) {
        $(current).before(this.$element.find("break"));
        /** @type {Node} */
        var node = current;
        current = current.parentNode;
        $(node).remove();
        /** @type {boolean} */
        udataCur = true;
      }
      if (this.getSelectionTextInfo(current).atEnd) {
        $(current).after(this.breakEnd(current), false);
        this.$element.find("break").remove();
        this.restoreSelectionByMarkers();
      } else {
        if (this.getSelectionTextInfo(current).atStart) {
          if (this.options.paragraphy) {
            if (udataCur) {
              $(current).before("<" + this.options.defaultTag + ">" + this.markers_html + this.br + "</" + this.options.defaultTag + ">");
              this.restoreSelectionByMarkers();
            } else {
              $(current).before("<" + this.options.defaultTag + ">" + this.br + "</" + this.options.defaultTag + ">");
            }
          } else {
            if (udataCur) {
              $(current).before(this.markers_html + "<br/>");
              this.restoreSelectionByMarkers();
            } else {
              $(current).before("<br/>");
            }
          }
          this.$element.find("break").remove();
        } else {
          if ("PRE" == current.tagName) {
            this.$element.find("break").after("<br/>" + this.markers_html);
            this.$element.find("break").remove();
            this.restoreSelectionByMarkers();
          } else {
            this.breakMiddle(current, false, udataCur);
            this.restoreSelectionByMarkers();
          }
        }
      }
    } else {
      this.enterInMainElement(current);
    }
  };
  /**
   * @param {Node} parent
   * @param {boolean} dataAndEvents
   * @return {?}
   */
  $.Editable.prototype.breakEnd = function(parent, dataAndEvents) {
    if (void 0 === dataAndEvents && (dataAndEvents = false), "BLOCKQUOTE" == parent.tagName) {
      var children = $(parent).contents();
      if (children.length) {
        if ("BR" == children[children.length - 1].tagName) {
          $(children[children.length - 1]).remove();
        }
      }
    }
    var el = $(parent).find("break").get(0);
    var offset = this.br;
    if (!this.options.paragraphy) {
      /** @type {string} */
      offset = "<br/>";
    }
    var index = this.markers_html + offset;
    if (dataAndEvents) {
      index = this.markers_html + $.Editable.INVISIBLE_SPACE;
    }
    for (; el != parent;) {
      if ("A" != el.tagName) {
        if ("BREAK" != el.tagName) {
          /** @type {string} */
          index = "<" + el.tagName + this.attrs(el) + ">" + index + "</" + el.tagName + ">";
        }
      }
      el = el.parentNode;
    }
    return dataAndEvents && ("A" != el.tagName && ("BREAK" != el.tagName && (index = "<" + el.tagName + this.attrs(el) + ">" + index + "</" + el.tagName + ">"))), this.options.paragraphy && (index = "<" + this.options.defaultTag + ">" + index + "</" + this.options.defaultTag + ">"), dataAndEvents && (index = offset + index), index;
  };
  /**
   * @param {Node} element
   * @param {boolean} recurring
   * @param {boolean} value
   * @return {undefined}
   */
  $.Editable.prototype.breakMiddle = function(element, recurring, value) {
    if (void 0 === recurring) {
      /** @type {boolean} */
      recurring = false;
    }
    if (void 0 === value) {
      /** @type {boolean} */
      value = false;
    }
    var ancestor = $(element).find("break").get(0);
    var g = this.markers_html;
    if (value) {
      /** @type {string} */
      g = "";
    }
    /** @type {string} */
    var s = "";
    for (; ancestor != element;) {
      ancestor = ancestor.parentNode;
      /** @type {string} */
      s = s + "</" + ancestor.tagName + ">";
      /** @type {string} */
      g = "<" + ancestor.tagName + this.attrs(ancestor) + ">" + g;
    }
    /** @type {string} */
    var r = "";
    if (value) {
      /** @type {string} */
      r = this.options.paragraphy ? "<" + this.options.defaultTag + ">" + this.markers_html + "<br/></" + this.options.defaultTag + ">" : this.markers_html + "<br/>";
    }
    /** @type {string} */
    var fixed = "<" + element.tagName + this.attrs(element) + ">" + $(element).html() + "</" + element.tagName + ">";
    /** @type {string} */
    fixed = fixed.replace(/<break><\/break>/, s + (recurring ? this.br : "") + r + g);
    $(element).replaceWith(fixed);
  };
}(jQuery),
function(obj) {
  /**
   * @param {Element} element
   * @return {?}
   */
  obj.Editable.prototype.isFirstSibling = function(element) {
    var token = element.previousSibling;
    return token ? 3 == token.nodeType && "" === token.textContent ? this.isFirstSibling(token) : false : true;
  };
  /**
   * @param {?} elem
   * @return {?}
   */
  obj.Editable.prototype.isLastSibling = function(elem) {
    var parent = elem.nextSibling;
    return parent ? 3 == parent.nodeType && "" === parent.textContent ? this.isLastSibling(parent) : false : true;
  };
  /**
   * @param {HTMLElement} el
   * @return {?}
   */
  obj.Editable.prototype.getDeepParent = function(el) {
    return el.parentNode == this.$element.get(0) ? el : this.getDeepParent(el.parentNode);
  };
  /**
   * @param {Node} element
   * @return {?}
   */
  obj.Editable.prototype.attrs = function(element) {
    /** @type {string} */
    var optsData = "";
    var ca = element.attributes;
    /** @type {number} */
    var i = 0;
    for (; i < ca.length; i++) {
      var c = ca[i];
      optsData += " " + c.nodeName + '="' + c.value + '"';
    }
    return optsData;
  };
}(jQuery),
function(factory) {
  if ("function" == typeof define && define.amd) {
    define(["jquery"], factory);
  } else {
    factory(jQuery);
  }
}(function(jQuery, selector) {
  /**
   * @param {Object} name
   * @return {undefined}
   */
  function Timer(name) {
    /**
     * @return {undefined}
     */
    function trigger() {
      if (context) {
        info();
        requestFrame(trigger);
        /** @type {boolean} */
        e = true;
        /** @type {boolean} */
        context = false;
      } else {
        /** @type {boolean} */
        e = false;
      }
    }
    /** @type {Object} */
    var info = name;
    /** @type {boolean} */
    var context = false;
    /** @type {boolean} */
    var e = false;
    /**
     * @return {undefined}
     */
    this.kick = function() {
      /** @type {boolean} */
      context = true;
      if (!e) {
        trigger();
      }
    };
    /**
     * @param {Function} cb
     * @return {undefined}
     */
    this.end = function(cb) {
      var swipeHandler = info;
      if (cb) {
        if (e) {
          info = context ? function() {
            swipeHandler();
            cb();
          } : cb;
          /** @type {boolean} */
          context = true;
        } else {
          cb();
        }
      }
    };
  }
  /**
   * @return {?}
   */
  function returnTrue() {
    return true;
  }
  /**
   * @return {?}
   */
  function returnFalse() {
    return false;
  }
  /**
   * @param {?} event
   * @return {undefined}
   */
  function callback(event) {
    event.preventDefault();
  }
  /**
   * @param {Event} e
   * @return {undefined}
   */
  function preventIgnoreTags(e) {
    if (!ignoreTags[e.target.tagName.toLowerCase()]) {
      e.preventDefault();
    }
  }
  /**
   * @param {Event} e
   * @return {?}
   */
  function isLeftButton(e) {
    return 1 === e.which && (!e.ctrlKey && !e.altKey);
  }
  /**
   * @param {Array} touchList
   * @param {?} id
   * @return {?}
   */
  function identifiedTouch(touchList, id) {
    var i;
    var subLn;
    if (touchList.identifiedTouch) {
      return touchList.identifiedTouch(id);
    }
    /** @type {number} */
    i = -1;
    subLn = touchList.length;
    for (; ++i < subLn;) {
      if (touchList[i].identifier === id) {
        return touchList[i];
      }
    }
  }
  /**
   * @param {Event} e
   * @param {Touch} event
   * @return {?}
   */
  function changedTouch(e, event) {
    var touch = identifiedTouch(e.changedTouches, event.identifier);
    if (touch && (touch.pageX !== event.pageX || touch.pageY !== event.pageY)) {
      return touch;
    }
  }
  /**
   * @param {Event} e
   * @return {undefined}
   */
  function mousedown(e) {
    var data;
    if (isLeftButton(e)) {
      data = {
        target: e.target,
        startX: e.pageX,
        startY: e.pageY,
        timeStamp: e.timeStamp
      };
      add(document, mouseevents.move, mousemove, data);
      add(document, mouseevents.cancel, mouseend, data);
    }
  }
  /**
   * @param {Event} e
   * @return {undefined}
   */
  function mousemove(e) {
    var data = e.data;
    checkThreshold(e, data, e, removeMouse);
  }
  /**
   * @return {undefined}
   */
  function mouseend() {
    removeMouse();
  }
  /**
   * @return {undefined}
   */
  function removeMouse() {
    remove(document, mouseevents.move, mousemove);
    remove(document, mouseevents.cancel, mouseend);
  }
  /**
   * @param {Event} e
   * @return {undefined}
   */
  function touchstart(e) {
    var touch;
    var template;
    if (!ignoreTags[e.target.tagName.toLowerCase()]) {
      touch = e.changedTouches[0];
      template = {
        target: touch.target,
        startX: touch.pageX,
        startY: touch.pageY,
        timeStamp: e.timeStamp,
        identifier: touch.identifier
      };
      add(document, touchevents.move + "." + touch.identifier, touchmove, template);
      add(document, touchevents.cancel + "." + touch.identifier, touchend, template);
    }
  }
  /**
   * @param {Event} e
   * @return {undefined}
   */
  function touchmove(e) {
    var data = e.data;
    var touch = changedTouch(e, data);
    if (touch) {
      checkThreshold(e, data, touch, removeTouch);
    }
  }
  /**
   * @param {Event} e
   * @return {undefined}
   */
  function touchend(e) {
    var template = e.data;
    var touch = identifiedTouch(e.changedTouches, template.identifier);
    if (touch) {
      removeTouch(template.identifier);
    }
  }
  /**
   * @param {string} identifier
   * @return {undefined}
   */
  function removeTouch(identifier) {
    remove(document, "." + identifier, touchmove);
    remove(document, "." + identifier, touchend);
  }
  /**
   * @param {Event} e
   * @param {Object} template
   * @param {Event} touch
   * @param {Function} fn
   * @return {undefined}
   */
  function checkThreshold(e, template, touch, fn) {
    /** @type {number} */
    var distX = touch.pageX - template.startX;
    /** @type {number} */
    var distY = touch.pageY - template.startY;
    if (!(a3 * a3 > distX * distX + distY * distY)) {
      triggerStart(e, template, touch, distX, distY, fn);
    }
  }
  /**
   * @return {?}
   */
  function handled() {
    return this._handled = returnTrue, false;
  }
  /**
   * @param {?} e
   * @return {?}
   */
  function preventDefault(e) {
    try {
      e._handled();
    } catch (b) {
      return false;
    }
  }
  /**
   * @param {Event} e
   * @param {Object} template
   * @param {Event} touch
   * @param {number} distX
   * @param {number} distY
   * @param {Function} fn
   * @return {undefined}
   */
  function triggerStart(e, template, touch, distX, distY, fn) {
    var touches;
    var time;
    template.target;
    touches = e.targetTouches;
    /** @type {number} */
    time = e.timeStamp - template.timeStamp;
    /** @type {string} */
    template.type = "movestart";
    /** @type {number} */
    template.distX = distX;
    /** @type {number} */
    template.distY = distY;
    /** @type {number} */
    template.deltaX = distX;
    /** @type {number} */
    template.deltaY = distY;
    template.pageX = touch.pageX;
    template.pageY = touch.pageY;
    /** @type {number} */
    template.velocityX = distX / time;
    /** @type {number} */
    template.velocityY = distY / time;
    template.targetTouches = touches;
    template.finger = touches ? touches.length : 1;
    /** @type {function (): ?} */
    template._handled = handled;
    /**
     * @return {undefined}
     */
    template._preventTouchmoveDefault = function() {
      e.preventDefault();
    };
    trigger(template.target, template);
    fn(template.identifier);
  }
  /**
   * @param {number} e
   * @return {undefined}
   */
  function activeMousemove(e) {
    var timer = e.data.timer;
    /** @type {number} */
    e.data.touch = e;
    e.data.timeStamp = e.timeStamp;
    timer.kick();
  }
  /**
   * @param {MessageEvent} e
   * @return {undefined}
   */
  function activeMouseend(e) {
    var event = e.data.event;
    var timer = e.data.timer;
    removeActiveMouse();
    endEvent(event, timer, function() {
      setTimeout(function() {
        remove(event.target, "click", returnFalse);
      }, 0);
    });
  }
  /**
   * @return {undefined}
   */
  function removeActiveMouse() {
    remove(document, mouseevents.move, activeMousemove);
    remove(document, mouseevents.end, activeMouseend);
  }
  /**
   * @param {Event} e
   * @return {undefined}
   */
  function activeTouchmove(e) {
    var event = e.data.event;
    var timer = e.data.timer;
    var touch = changedTouch(e, event);
    if (touch) {
      e.preventDefault();
      event.targetTouches = e.targetTouches;
      e.data.touch = touch;
      e.data.timeStamp = e.timeStamp;
      timer.kick();
    }
  }
  /**
   * @param {Event} e
   * @return {undefined}
   */
  function activeTouchend(e) {
    var event = e.data.event;
    var timer = e.data.timer;
    var touch = identifiedTouch(e.changedTouches, event.identifier);
    if (touch) {
      removeActiveTouch(event);
      endEvent(event, timer);
    }
  }
  /**
   * @param {(Touch|number)} event
   * @return {undefined}
   */
  function removeActiveTouch(event) {
    remove(document, "." + event.identifier, activeTouchmove);
    remove(document, "." + event.identifier, activeTouchend);
  }
  /**
   * @param {Object} event
   * @param {Touch} touch
   * @param {number} timeStamp
   * @return {undefined}
   */
  function updateEvent(event, touch, timeStamp) {
    /** @type {number} */
    var time = timeStamp - event.timeStamp;
    /** @type {string} */
    event.type = "move";
    /** @type {number} */
    event.distX = touch.pageX - event.startX;
    /** @type {number} */
    event.distY = touch.pageY - event.startY;
    /** @type {number} */
    event.deltaX = touch.pageX - event.pageX;
    /** @type {number} */
    event.deltaY = touch.pageY - event.pageY;
    /** @type {number} */
    event.velocityX = 0.3 * event.velocityX + 0.7 * event.deltaX / time;
    /** @type {number} */
    event.velocityY = 0.3 * event.velocityY + 0.7 * event.deltaY / time;
    event.pageX = touch.pageX;
    event.pageY = touch.pageY;
  }
  /**
   * @param {Object} event
   * @param {?} timer
   * @param {Object} fn
   * @return {undefined}
   */
  function endEvent(event, timer, fn) {
    timer.end(function() {
      return event.type = "moveend", trigger(event.target, event), fn && fn();
    });
  }
  /**
   * @return {?}
   */
  function setup() {
    return add(this, "movestart.move", preventDefault), true;
  }
  /**
   * @return {?}
   */
  function teardown() {
    return remove(this, "dragstart drag", callback), remove(this, "mousedown touchstart", preventIgnoreTags), remove(this, "movestart", preventDefault), true;
  }
  /**
   * @param {Object} handleObj
   * @return {undefined}
   */
  function addMethod(handleObj) {
    if ("move" !== handleObj.namespace) {
      if ("moveend" !== handleObj.namespace) {
        add(this, "dragstart." + handleObj.guid + " drag." + handleObj.guid, callback, selector, handleObj.selector);
        add(this, "mousedown." + handleObj.guid, preventIgnoreTags, selector, handleObj.selector);
      }
    }
  }
  /**
   * @param {Object} handleObj
   * @return {undefined}
   */
  function removeMethod(handleObj) {
    if ("move" !== handleObj.namespace) {
      if ("moveend" !== handleObj.namespace) {
        remove(this, "dragstart." + handleObj.guid + " drag." + handleObj.guid);
        remove(this, "mousedown." + handleObj.guid);
      }
    }
  }
  /** @type {number} */
  var a3 = 6;
  var add = jQuery.event.add;
  var remove = jQuery.event.remove;
  /**
   * @param {?} elem
   * @param {Object} type
   * @param {?} extra
   * @return {undefined}
   */
  var trigger = function(elem, type, extra) {
    jQuery.event.trigger(type, extra, elem);
  };
  var requestFrame = function() {
    return window.requestAnimationFrame || (window.webkitRequestAnimationFrame || (window.mozRequestAnimationFrame || (window.oRequestAnimationFrame || (window.msRequestAnimationFrame || function($sanitize) {
      return window.setTimeout(function() {
        $sanitize();
      }, 25);
    }))));
  }();
  var ignoreTags = {
    textarea: true,
    input: true,
    select: true,
    button: true
  };
  var mouseevents = {
    move: "mousemove",
    cancel: "mouseup dragstart",
    end: "mouseup"
  };
  var touchevents = {
    move: "touchmove",
    cancel: "touchend",
    end: "touchend"
  };
  jQuery.event.special.movestart = {
    /** @type {function (): ?} */
    setup: setup,
    /** @type {function (): ?} */
    teardown: teardown,
    /** @type {function (Object): undefined} */
    add: addMethod,
    /** @type {function (Object): undefined} */
    remove: removeMethod,
    /**
     * @param {Object} e
     * @return {undefined}
     */
    _default: function(e) {
      /**
       * @return {undefined}
       */
      function update() {
        updateEvent(event, data.touch, data.timeStamp);
        trigger(e.target, event);
      }
      var event;
      var data;
      if (e._handled()) {
        event = {
          target: e.target,
          startX: e.startX,
          startY: e.startY,
          pageX: e.pageX,
          pageY: e.pageY,
          distX: e.distX,
          distY: e.distY,
          deltaX: e.deltaX,
          deltaY: e.deltaY,
          velocityX: e.velocityX,
          velocityY: e.velocityY,
          timeStamp: e.timeStamp,
          identifier: e.identifier,
          targetTouches: e.targetTouches,
          finger: e.finger
        };
        data = {
          event: event,
          timer: new Timer(update),
          touch: selector,
          timeStamp: selector
        };
        if (e.identifier === selector) {
          add(e.target, "click", returnFalse);
          add(document, mouseevents.move, activeMousemove, data);
          add(document, mouseevents.end, activeMouseend, data);
        } else {
          e._preventTouchmoveDefault();
          add(document, touchevents.move + "." + e.identifier, activeTouchmove, data);
          add(document, touchevents.end + "." + e.identifier, activeTouchend, data);
        }
      }
    }
  };
  jQuery.event.special.move = {
    /**
     * @return {undefined}
     */
    setup: function() {
      add(this, "movestart.move", jQuery.noop);
    },
    /**
     * @return {undefined}
     */
    teardown: function() {
      remove(this, "movestart.move", jQuery.noop);
    }
  };
  jQuery.event.special.moveend = {
    /**
     * @return {undefined}
     */
    setup: function() {
      add(this, "movestart.moveend", jQuery.noop);
    },
    /**
     * @return {undefined}
     */
    teardown: function() {
      remove(this, "movestart.moveend", jQuery.noop);
    }
  };
  add(document, "mousedown.move", mousedown);
  add(document, "touchstart.move", touchstart);
  if ("function" == typeof Array.prototype.indexOf) {
    ! function($) {
      /** @type {Array} */
      var props = ["changedTouches", "targetTouches"];
      /** @type {number} */
      var l = props.length;
      for (; l--;) {
        if (-1 === $.event.props.indexOf(props[l])) {
          $.event.props.push(props[l]);
        }
      }
    }(jQuery);
  }
}), window.WYSIWYGModernizr = function(win, doc, dataAndEvents) {
    /**
     * @param {string} str
     * @return {undefined}
     */
    function setCss(str) {
      /** @type {string} */
      mStyle.cssText = str;
    }
    /**
     * @param {Function} obj
     * @param {string} type
     * @return {?}
     */
    function is(obj, type) {
      return typeof obj === type;
    }
    var inputElem;
    var featureName;
    var hasOwn;
    /** @type {string} */
    var version = "2.7.1";
    var Modernizr = {};
    /** @type {Element} */
    var docElement = doc.documentElement;
    /** @type {string} */
    var mod = "modernizr";
    /** @type {Element} */
    var modElem = doc.createElement(mod);
    /** @type {(CSSStyleDeclaration|null)} */
    var mStyle = modElem.style;
    /** @type {Array.<string>} */
    var prefixes = ({}.toString, " -webkit- -moz- -o- -ms- ".split(" "));
    var obj = {};
    /** @type {Array} */
    var classes = [];
    /** @type {function (this:(Array.<T>|string|{length: number}), *=, *=): Array.<T>} */
    var __slice = classes.slice;
    /**
     * @param {string} rule
     * @param {Function} callback
     * @param {number} nodes
     * @param {Array} testnames
     * @return {?}
     */
    var injectElementWithStyles = function(rule, callback, nodes, testnames) {
      var style;
      var ret;
      var node;
      var docOverflow;
      /** @type {Element} */
      var div = doc.createElement("div");
      /** @type {(HTMLElement|null)} */
      var body = doc.body;
      /** @type {Element} */
      var fakeBody = body || doc.createElement("body");
      if (parseInt(nodes, 10)) {
        for (; nodes--;) {
          /** @type {Element} */
          node = doc.createElement("div");
          node.id = testnames ? testnames[nodes] : mod + (nodes + 1);
          div.appendChild(node);
        }
      }
      return style = ["&#173;", '<style id="s', mod, '">', rule, "</style>"].join(""), div.id = mod, (body ? div : fakeBody).innerHTML += style, fakeBody.appendChild(div), body || (fakeBody.style.background = "", fakeBody.style.overflow = "hidden", docOverflow = docElement.style.overflow, docElement.style.overflow = "hidden", docElement.appendChild(fakeBody)), ret = callback(div, rule), body ? div.parentNode.removeChild(div) : (fakeBody.parentNode.removeChild(fakeBody), docElement.style.overflow =
        docOverflow), !!ret;
    };
    /**
     * @param {string} mq
     * @return {?}
     */
    var testMediaQuery = function(mq) {
      /** @type {function (this:Window, string): (MediaQueryList|null)} */
      var matchMedia = win.matchMedia || win.msMatchMedia;
      if (matchMedia) {
        return matchMedia(mq).matches;
      }
      var absolute;
      return injectElementWithStyles("@media " + mq + " { #" + mod + " { position: absolute; } }", function(elem) {
        /** @type {boolean} */
        absolute = "absolute" == (win.getComputedStyle ? getComputedStyle(elem, null) : elem.currentStyle).position;
      }), absolute;
    };
    /** @type {function (this:Object, *): boolean} */
    var _hasOwnProperty = {}.hasOwnProperty;
    /** @type {function (Object, string): ?} */
    hasOwn = is(_hasOwnProperty, "undefined") || is(_hasOwnProperty.call, "undefined") ? function(object, property) {
      return property in object && is(object.constructor.prototype[property], "undefined");
    } : function(object, key) {
      return _hasOwnProperty.call(object, key);
    };
    if (!Function.prototype.bind) {
      /**
       * @param {(Object|null|undefined)} obj
       * @return {Function}
       */
      Function.prototype.bind = function(obj) {
        /** @type {Function} */
        var fn = this;
        if ("function" != typeof fn) {
          throw new TypeError;
        }

        var args = __slice.call(arguments, 1);
        /**
         * @return {?}
         */
        var bound = function() {
          if (this instanceof bound) {
            /**
             * @return {undefined}
             */
            var F = function() {};
            F.prototype = fn.prototype;
            var self = new F;
            var result = fn.apply(self, args.concat(__slice.call(arguments)));
            return Object(result) === result ? result : self;
          }
          return fn.apply(obj, args.concat(__slice.call(arguments)));
        };
        return bound;
      };
    }
    /**
     * @return {?}
     */
    obj.touch = function() {
      var c;
      return "ontouchstart" in win || win.DocumentTouch && doc instanceof DocumentTouch ? c = true : injectElementWithStyles(["@media (", prefixes.join("touch-enabled),("), mod, ")", "{#modernizr{top:9px;position:absolute}}"].join(""), function(td) {
        /** @type {boolean} */
        c = 9 === td.offsetTop;
      }), c;
    };
    var key;
    for (key in obj) {
      if (hasOwn(obj, key)) {
        /** @type {string} */
        featureName = key.toLowerCase();
        Modernizr[featureName] = obj[key]();
        classes.push((Modernizr[featureName] ? "" : "no-") + featureName);
      }
    }
    return Modernizr.addTest = function(feature, test) {
      if ("object" == typeof feature) {
        var key;
        for (key in feature) {
          if (hasOwn(feature, key)) {
            Modernizr.addTest(key, feature[key]);
          }
        }
      } else {
        if (feature = feature.toLowerCase(), Modernizr[feature] !== dataAndEvents) {
          return Modernizr;
        }
        test = "function" == typeof test ? test() : test;
        if ("undefined" != typeof enableClasses) {
          if (enableClasses) {
            docElement.className += " " + (test ? "" : "no-") + feature;
          }
        }
        /** @type {boolean} */
        Modernizr[feature] = test;
      }
      return Modernizr;
    }, setCss(""), modElem = inputElem = null, Modernizr._version = version, Modernizr._prefixes = prefixes, Modernizr.mq = testMediaQuery, Modernizr.testStyles = injectElementWithStyles, Modernizr;
  }(this, document), ! function(obj) {
    /**
     * @return {undefined}
     *
     *
     * BEGIN LICENSECHECK boxi ?
     * 
     * 
     */
    obj.Editable.prototype.coreInit = function() {
      var self = this;
      /** @type {string} */
      var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
      /**
       * @param {(number|string)} err
       * @return {?}
       */
      var next = function(err) {
        var haystack = err.toString();
        /** @type {number} */
        var offsetTop = 0;
        /** @type {number} */
        var i = 0;
        for (; i < haystack.length; i++) {
          offsetTop += parseInt(haystack.charAt(i), 10);
        }
        return offsetTop > 10 ? offsetTop % 9 + 1 : offsetTop;
      };
      if (self.options.key === false) { // !== false
        /**
         * @param {number} models
         * @param {number} callback
         * @param {number} value
         * @return {?}
         */
        var reset = function(models, callback, value) {
          /** @type {number} */
          var isFunction = Math.abs(value);
          for (; isFunction-- > 0;) {
            models -= callback;
          }
          return 0 > value && (models += 123), models;
        };
        /**
         * @param {string} object
         * @return {?}
         */
        var freeze = function(object) {
          return object;
        };
        /**
         * @param {(Array|number)} values
         * @return {?}
         */
        var set = function(values) {
          if (!values) {
            return values;
          }
          /** @type {string} */
          var result = "";
          var nMod10 = freeze("charCodeAt");
          //var ps = freeze("fromCharCode");
          //console.log()
          /** @type {number} */
          var i = chars.indexOf(values[0]);
          /** @type {number} */
          var n = 1;
          for (; n < values.length - 2; n++) {
            var restoreScript = next(++i);
            var id = values[nMod10](n);
            /** @type {string} */
            var width = "";
            for (;
              /[0-9-]/.test(values[n + 1]);) {
              width += values[++n];
            }
            /** @type {number} */
            width = parseInt(width, 10) || 0;
            id = reset(id, restoreScript, width);
            id ^= i - 1 & 31;
            //result += String[ps](id);
            console.log(ps);
          }
          return result;
        };
        var $ = freeze(set);
        /**
         * @param {Object} a
         * @return {?}
         */
        var f = function(a) {
          //return "none" == a.css("display") ? (a.attr("style", a.attr("style") + $("zD4D2qJ-7dhuB-11bB4E1wqlhlfE4gjhkbB6C5eg1C-8h1besB-16e1==")), true) : false;
        };
        var value = function() {
          /** @type {number} */
          var a = 0;
          /** @type {string} */
          var url = document.domain;
          /** @type {Array.<string>} */
          var models = url.split(".");
          /** @type {string} */
          var uid = "_gd" + (new Date).getTime();
          for (; a < models.length - 1 && -1 == document.cookie.indexOf(uid + "=" + uid);) {
            /** @type {string} */
            url = models.slice(-1 - ++a).join(".");
            /** @type {string} */
            document.cookie = uid + "=" + uid + ";domain=" + url + ";";
          }
          return document.cookie = uid + "=;expires=Thu, 01 Jan 1970 00:00:01 GMT;domain=" + url + ";", url;
        }();
        /**
         * @return {?}
         */
        var _build = function() {
          //var ea = $(self.options.key) || "";
          // return ea !== $("eQZMe1NJGC1HTMVANU==") && (ea.indexOf(value, ea.length - value.length) < 0 && [$("9qqG-7amjlwq=="), $("KA3B3C2A6D1D5H5H1A3==")].indexOf(value) < 0) ? (self.$box.append($("uA5kygD3g1h1lzrA7E2jtotjvooB2A5eguhdC-22C-16nC2B3lh1deA-21C-16B4A2B4gi1F4D1wyA-13jA4H5C2rA-65A1C10dhzmoyJ2A10A-21d1B-13xvC2I4enC4C2B5B4G4G4H1H4A10aA8jqacD1C3c1B-16D-13A-13B2E5A4jtxfB-13fA1pewxvzA3E-11qrB4E4qwB-16icA1B3ykohde1hF4A2E4clA4C7E6haA4D1xtmolf1F-10A1H4lhkagoD5naalB-22B8B4quvB-8pjvouxB3A-9plnpA2B6D6BD2D1C2H1C3C3A4mf1G-10C-8i1G3C5B3pqB-9E5B1oyejA3ddalvdrnggE3C3bbj1jC6B3D3gugqrlD8B2DB-9qC-7qkA10D2VjiodmgynhA4HA-9D-8pI-7rD4PrE-11lvhE3B5A-16C7A6A3ekuD1==")), 
          // self.$lb = self.$box.find("> div:last"), self.$ab = self.$lb.find("> a"), f(self.$lb) || f(self.$ab)) : void 0;
        };
        _build();
      }
    };
    obj.Editable.initializers.push(obj.Editable.prototype.coreInit);
    /*
     * 
     * END LICENSECHECK
     * 
     * 
     */
  }(jQuery),
  function($) {
    $.Editable.DEFAULTS = $.extend($.Editable.DEFAULTS, {
      allowedBlankTags: ["TEXTAREA"],
      selfClosingTags: ["br", "input", "img", "hr", "param", "!--", "source", "embed", "!", "meta", "link", "base"],
      doNotJoinTags: ["a"],
      iconClasses: ["fa-"]
    });
    /**
     * @param {string} string
     * @return {?}
     */
    $.Editable.prototype.isClosingTag = function(string) {
      return string ? null !== string.match(/^<\/([a-zA-Z0-9]+)([^<]+)*>$/gi) : false;
    };
    /**
     * @param {string} string
     * @return {?}
     */
    $.Editable.prototype.tagName = function(string) {
      return string.replace(/^<\/?([a-zA-Z0-9-!]+)([^>]+)*>$/gi, "$1").toLowerCase();
    };
    /** @type {Array} */
    $.Editable.SELF_CLOSING_AFTER = ["source"];
    /**
     * @param {string} string
     * @return {?}
     */
    $.Editable.prototype.isSelfClosingTag = function(string) {
      var match = this.tagName(string);
      return this.options.selfClosingTags.indexOf(match.toLowerCase()) >= 0;
    };
    /**
     * @param {Object} elem
     * @return {?}
     */
    $.Editable.prototype.tagKey = function(elem) {
      return elem.type + (elem.attrs || []).sort().join("|");
    };
    /**
     * @param {HTMLElement} chunk
     * @return {?}
     */
    $.Editable.prototype.extendedKey = function(chunk) {
      return this.tagKey(chunk) + JSON.stringify(chunk.style);
    };
    /**
     * @param {Node} element
     * @return {?}
     */
    $.Editable.prototype.mapDOM = function(element) {
      /** @type {Array} */
      var list = [];
      var cache = {};
      var players = {};
      /** @type {number} */
      var msgId = 0;
      var elem = this;
      $(element).find(".f-marker").html($.Editable.INVISIBLE_SPACE);
      /**
       * @param {Node} node
       * @param {?} cur
       * @return {?}
       */
      var parse = function(node, cur) {
        if (3 === node.nodeType) {
          return [];
        }
        if (8 === node.nodeType) {
          return [{
            comment: true,
            attrs: {},
            styles: {},
            idx: msgId++,
            sp: cur,
            ep: cur,
            text: node.textContent
          }];
        }
        var tagName = node.tagName;
        if ("B" == tagName) {
          /** @type {string} */
          tagName = "STRONG";
        }
        if (!("I" != tagName)) {
          if (!(node.className && null != node.className.match(new RegExp(elem.options.iconClasses.join("|"), "gi")))) {
            /** @type {string} */
            tagName = "EM";
          }
        }
        var attrs = {};
        var data = {};
        /** @type {null} */
        var name = null;
        if (node.attributes) {
          /** @type {number} */
          var i = 0;
          for (; i < node.attributes.length; i++) {
            var attr = node.attributes[i];
            if ("style" == attr.nodeName) {
              name = attr.value;
            } else {
              attrs[attr.nodeName] = attr.value;
            }
          }
        }
        if (name) {
          var parameters = name.match(/([^:]*):([^:;]*(;|$))/gi);
          if (parameters) {
            /** @type {number} */
            var p = 0;
            for (; p < parameters.length; p++) {
              var parts = parameters[p].split(":");
              var callbackName = parts.slice(1).join(":").trim();
              if (";" == callbackName[callbackName.length - 1]) {
                callbackName = callbackName.substr(0, callbackName.length - 1);
              }
              data[parts[0].trim()] = callbackName;
            }
          }
        }
        /** @type {Array} */
        var models = [];
        if ($.isEmptyObject(attrs) && ("SPAN" == node.tagName && !$.isEmptyObject(data))) {
          var prop;
          for (prop in data) {
            var cache = {};
            cache[prop] = data[prop];
            models.push({
              selfClosing: false,
              attrs: attrs,
              styles: cache,
              idx: msgId++,
              sp: cur,
              ep: cur + node.textContent.length,
              tagName: tagName,
              noJoin: node.nextSibling && "BR" === node.nextSibling.tagName
            });
          }
          return models;
        }
        return [{
          selfClosing: elem.options.selfClosingTags.indexOf(tagName.toLowerCase()) >= 0,
          attrs: attrs,
          styles: data,
          idx: msgId++,
          sp: cur,
          ep: cur + node.textContent.length,
          tagName: tagName,
          noJoin: node.nextSibling && "BR" === node.nextSibling.tagName
        }];
      };
      /**
       * @param {Node} parent
       * @param {number} part
       * @return {undefined}
       */
      var parseNode = function(parent, part) {
        var i;
        var codeSegments;
        var data;
        if (parent != element) {
          codeSegments = parse(parent, part);
          /** @type {number} */
          i = 0;
          for (; i < codeSegments.length; i++) {
            data = codeSegments[i];
            list.push(data);
            if (!cache[data.sp]) {
              cache[data.sp] = {};
            }
            if (!players[data.ep]) {
              players[data.ep] = {};
            }
            if (!cache[data.sp][data.tagName]) {
              /** @type {Array} */
              cache[data.sp][data.tagName] = [];
            }
            if (!players[data.ep][data.tagName]) {
              /** @type {Array} */
              players[data.ep][data.tagName] = [];
            }
            cache[data.sp][data.tagName].push(data);
            players[data.ep][data.tagName].push(data);
          }
        }
        var children = parent.childNodes;
        if (children) {
          /** @type {number} */
          i = 0;
          for (; i < children.length; i++) {
            if (i > 0) {
              if (8 != children[i - 1].nodeType) {
                part += children[i - 1].textContent.length;
              }
            }
            parseNode(children[i], part);
          }
          if (codeSegments) {
            /** @type {number} */
            i = 0;
            for (; i < codeSegments.length; i++) {
              data = codeSegments[i];
              /** @type {number} */
              data.ci = msgId++;
              if (!cache[data.ep]) {
                cache[data.ep] = {};
              }
              if (!cache[data.ep][data.tagName]) {
                /** @type {Array} */
                cache[data.ep][data.tagName] = [];
              }
              cache[data.ep][data.tagName].push({
                shadow: true,
                ci: msgId - 1
              });
            }
          }
        }
      };
      /**
       * @return {undefined}
       */
      var update = function() {
        var id;
        var o;
        var index;
        var data;
        for (id in cache) {
          var eventName;
          for (eventName in cache[id]) {
            /** @type {number} */
            index = 0;
            for (; index < cache[id][eventName].length; index++) {
              if (o = cache[id][eventName][index], !o.selfClosing && !(o.dirty || (o.shadow || (o.comment || o.noJoin)))) {
                /** @type {number} */
                var j = index + 1;
                for (; j < cache[id][eventName].length; j++) {
                  if (data = cache[id][eventName][j], !data.selfClosing && !(data.dirty || (data.shadow || (data.comment || (data.noJoin || (1 != Object.keys(o.styles).length || (1 != Object.keys(data.styles).length || data.sp == data.ep))))))) {
                    /** @type {string} */
                    var k = Object.keys(o.styles)[0];
                    if (data.styles[k]) {
                      o.sp = data.ep;
                      /** @type {number} */
                      var i = 0;
                      for (; i < cache[o.sp][o.tagName].length; i++) {
                        var player = cache[o.sp][o.tagName][i];
                        if (player.shadow && player.ci == data.ci) {
                          cache[o.sp][o.tagName].splice(i, 0, o);
                          break;
                        }
                      }
                      cache[id][eventName].splice(index, 1);
                      index--;
                      break;
                    }
                  }
                }
              }
            }
          }
        }
        /** @type {number} */
        id = 0;
        for (; id < list.length; id++) {
          if (o = list[id], !(o.dirty || (o.selfClosing || (o.comment || (o.noJoin || (o.shadow || (elem.options.doNotJoinTags.indexOf(o.tagName.toLowerCase()) >= 0 || !$.isEmptyObject(o.attrs)))))))) {
            if (o.sp == o.ep && ($.isEmptyObject(o.attrs) && ($.isEmptyObject(o.styles) && elem.options.allowedBlankTags.indexOf(o.tagName) < 0))) {
              /** @type {boolean} */
              o.dirty = true;
            } else {
              if (cache[o.ep] && cache[o.ep][o.tagName]) {
                /** @type {number} */
                index = 0;
                for (; index < cache[o.ep][o.tagName].length; index++) {
                  if (data = cache[o.ep][o.tagName][index], o != data && !(data.dirty || (data.selfClosing || (data.shadow || (data.comment || (data.noJoin || (!$.isEmptyObject(data.attrs) || JSON.stringify(data.styles) != JSON.stringify(o.styles)))))))) {
                    if (o.ep < data.ep) {
                      o.ep = data.ep;
                    }
                    if (o.sp > data.sp) {
                      o.sp = data.sp;
                    }
                    /** @type {boolean} */
                    data.dirty = true;
                    id--;
                    break;
                  }
                }
              }
            }
          }
        }
        /** @type {number} */
        id = 0;
        for (; id < list.length; id++) {
          if (o = list[id], !(o.dirty || (o.selfClosing || (o.comment || (o.noJoin || (o.shadow || !$.isEmptyObject(o.attrs))))))) {
            if (o.sp == o.ep && ($.isEmptyObject(o.attrs) && ($.isEmptyObject(o.style) && elem.options.allowedBlankTags.indexOf(o.tagName) < 0))) {
              /** @type {boolean} */
              o.dirty = true;
            } else {
              if (cache[o.sp] && cache[o.sp][o.tagName]) {
                /** @type {number} */
                index = cache[o.sp][o.tagName].length - 1;
                for (; index >= 0; index--) {
                  data = cache[o.sp][o.tagName][index];
                  if (o != data) {
                    if (!data.dirty) {
                      if (!data.selfClosing) {
                        if (!data.shadow) {
                          if (!data.comment) {
                            if (!data.noJoin) {
                              if (o.ep == data.ep) {
                                if ($.isEmptyObject(data.attrs)) {
                                  o.styles = $.extend(o.styles, data.styles);
                                  /** @type {boolean} */
                                  data.dirty = true;
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      };
      parseNode(element, 0);
      update();
      /** @type {number} */
      var pos = list.length - 1;
      for (; pos >= 0; pos--) {
        if (list.dirty) {
          list.splice(pos, 1);
        }
      }
      return list;
    };
    /**
     * @param {Object} b
     * @param {?} a
     * @return {?}
     */
    $.Editable.prototype.sortNodes = function(b, a) {
      if (b.comment) {
        return 1;
      }
      if (b.selfClosing || a.selfClosing) {
        return b.idx - a.idx;
      }
      /** @type {number} */
      var min = b.ep - b.sp;
      /** @type {number} */
      var max = a.ep - a.sp;
      return 0 === min && 0 === max ? b.idx - a.idx : min === max ? a.ci - b.ci : max - min;
    };
    /**
     * @param {Object} node
     * @return {?}
     */
    $.Editable.prototype.openTag = function(node) {
      var index;
      var c = "<" + node.tagName.toLowerCase();
      var splitText = Object.keys(node.attrs).sort();
      /** @type {number} */
      index = 0;
      for (; index < splitText.length; index++) {
        var j = splitText[index];
        c += " " + j + '="' + node.attrs[j] + '"';
      }
      /** @type {string} */
      var classes = "";
      var items = Object.keys(node.styles).sort();
      /** @type {number} */
      index = 0;
      for (; index < items.length; index++) {
        var i = items[index];
        if (null != node.styles[i]) {
          classes += i.replace("_", "-") + ": " + node.styles[i] + "; ";
        }
      }
      return "" !== classes && (c += ' style="' + classes.trim() + '"'), c += ">";
    };
    /**
     * @param {Object} node
     * @return {?}
     */
    $.Editable.prototype.commentTag = function(node) {
      /** @type {string} */
      var optsData = "";
      if (node.selfClosing) {
        var index;
        optsData = "<" + node.tagName.toLowerCase();
        var splitText = Object.keys(node.attrs).sort();
        /** @type {number} */
        index = 0;
        for (; index < splitText.length; index++) {
          var j = splitText[index];
          optsData += " " + j + '="' + node.attrs[j] + '"';
        }
        /** @type {string} */
        var classes = "";
        var items = Object.keys(node.styles).sort();
        /** @type {number} */
        index = 0;
        for (; index < items.length; index++) {
          var i = items[index];
          if (null != node.styles[i]) {
            classes += i.replace("_", "-") + ": " + node.styles[i] + "; ";
          }
        }
        if ("" !== classes) {
          optsData += ' style="' + classes.trim() + '"';
        }
        optsData += "/>";
      } else {
        if (node.comment) {
          /** @type {string} */
          optsData = "\x3c!--" + node.text + "--\x3e";
        }
      }
      return optsData;
    };
    /**
     * @param {Element} el
     * @return {?}
     */
    $.Editable.prototype.closeTag = function(el) {
      return "</" + el.tagName.toLowerCase() + ">";
    };
    /**
     * @param {Array} callbacks
     * @param {?} clone
     * @return {?}
     */
    $.Editable.prototype.nodesOpenedAt = function(callbacks, clone) {
      /** @type {Array} */
      var eventPath = [];
      /** @type {number} */
      var i = callbacks.length - 1;
      for (; i >= 0 && callbacks[i].sp == clone;) {
        eventPath.push(callbacks.pop());
        i--;
      }
      return eventPath;
    };
    /**
     * @param {?} value
     * @return {?}
     */
    $.Editable.prototype.entity = function(value) {
      return ch_map = {
        ">": "&gt;",
        "<": "&lt;",
        "&": "&amp;"
      }, ch_map[value] ? ch_map[value] : value;
    };
    /**
     * @param {Node} d
     * @return {undefined}
     */
    $.Editable.prototype.removeInvisibleWhitespace = function(d) {
      /** @type {number} */
      var j = 0;
      for (; j < d.childNodes.length; j++) {
        var res = d.childNodes[j];
        if (res.childNodes.length) {
          this.removeInvisibleWhitespace(res);
        } else {
          res.textContent = res.textContent.replace(/\u200B/gi, "");
        }
      }
    };
    /**
     * @param {Node} data
     * @param {boolean} deepDataAndEvents
     * @return {?}
     */
    $.Editable.prototype.cleanOutput = function(data, deepDataAndEvents) {
      var i;
      var id;
      var y;
      var cur;
      if (deepDataAndEvents) {
        this.removeInvisibleWhitespace(data);
      }
      var scrubbed = this.mapDOM(data, deepDataAndEvents).sort(function(p, p2) {
        return p2.sp - p.sp;
      });
      var array = data.textContent;
      /** @type {string} */
      html = "";
      /** @type {Array} */
      var levels = [];
      /** @type {number} */
      var maxItemLength = -1;
      var throttledUpdate = $.proxy(function() {
        /** @type {string} */
        var str = "";
        /** @type {Array} */
        simple_nodes_to_close = [];
        levels = levels.sort(function(a, b) {
          return a.idx - b.idx;
        }).reverse();
        for (; levels.length;) {
          var node = levels.pop();
          for (; simple_nodes_to_close.length && simple_nodes_to_close[simple_nodes_to_close.length - 1].ci < node.ci;) {
            str += this.closeTag(simple_nodes_to_close.pop());
          }
          if (node.selfClosing || node.comment) {
            str += this.commentTag(node);
          } else {
            if (!$.isEmptyObject(node.attrs) || this.options.allowedBlankTags.indexOf(node.tagName) >= 0) {
              str += this.openTag(node);
              simple_nodes_to_close.push(node);
            }
          }
        }
        for (; simple_nodes_to_close.length;) {
          str += this.closeTag(simple_nodes_to_close.pop());
        }
        html += str;
      }, this);
      var result = {};
      /** @type {Array} */
      var items = [];
      /** @type {number} */
      i = 0;
      for (; i <= array.length; i++) {
        if (result[i]) {
          /** @type {number} */
          id = result[i].length - 1;
          for (; id >= 0; id--) {
            if (items.length && (items[items.length - 1].tagName == result[i][id].tagName && JSON.stringify(items[items.length - 1].styles) == JSON.stringify(result[i][id].styles))) {
              html += this.closeTag(result[i][id]);
              items.pop();
            } else {
              /** @type {Array} */
              var eventPath = [];
              for (; items.length && (items[items.length - 1].tagName !== result[i][id].tagName || JSON.stringify(items[items.length - 1].styles) !== JSON.stringify(result[i][id].styles));) {
                cur = items.pop();
                html += this.closeTag(cur);
                eventPath.push(cur);
              }
              html += this.closeTag(result[i][id]);
              items.pop();
              for (; eventPath.length;) {
                var chi = eventPath.pop();
                html += this.openTag(chi);
                items.push(chi);
              }
            }
          }
        }
        var stateHistory = this.nodesOpenedAt(scrubbed, i).sort(this.sortNodes).reverse();
        for (; stateHistory.length;) {
          var item = stateHistory.pop();
          if (!item.dirty) {
            if (item.selfClosing || item.comment) {
              if (item.ci > maxItemLength || "BR" == item.tagName) {
                throttledUpdate();
                html += this.commentTag(item);
                maxItemLength = item.ci;
              } else {
                if (levels.length) {
                  levels.push(item);
                  if (maxItemLength < item.ci) {
                    maxItemLength = item.ci;
                  }
                } else {
                  html += this.commentTag(item);
                  if (maxItemLength < item.ci) {
                    maxItemLength = item.ci;
                  }
                }
              }
            } else {
              if (item.ep > item.sp) {
                if (item.ci > maxItemLength) {
                  throttledUpdate();
                }
                /** @type {Array} */
                var braceStack = [];
                if ("A" == item.tagName) {
                  var x = item.sp + 1;
                  for (; x < item.ep; x++) {
                    if (result[x] && result[x].length) {
                      /** @type {number} */
                      y = 0;
                      for (; y < result[x].length; y++) {
                        braceStack.push(result[x][y]);
                        html += this.closeTag(result[x][y]);
                        items.pop();
                      }
                    }
                  }
                }
                /** @type {Array} */
                var changes = [];
                if ("SPAN" == item.tagName && ("#123456" == item.styles["background-color"] || ("#123456" === $.Editable.RGBToHex(item.styles["background-color"]) || ("#123456" == item.styles.color || "#123456" === $.Editable.RGBToHex(item.styles.color))))) {
                  for (; items.length;) {
                    var val = items.pop();
                    html += this.closeTag(val);
                    changes.push(val);
                  }
                }
                html += this.openTag(item);
                if (maxItemLength < item.ci) {
                  maxItemLength = item.ci;
                }
                items.push(item);
                if (!result[item.ep]) {
                  /** @type {Array} */
                  result[item.ep] = [];
                }
                result[item.ep].push(item);
                for (; braceStack.length;) {
                  item = braceStack.pop();
                  html += this.openTag(item);
                  items.push(item);
                }
                for (; changes.length;) {
                  item = changes.pop();
                  html += this.openTag(item);
                  items.push(item);
                }
              } else {
                if (item.sp == item.ep) {
                  levels.push(item);
                  if (maxItemLength < item.ci) {
                    maxItemLength = item.ci;
                  }
                }
              }
            }
          }
        }
        throttledUpdate();
        if (i != array.length) {
          html += this.entity(array[i]);
        }
      }
      return html = html.replace(/(<span[^>]*? class\s*=\s*["']?f-marker["']?[^>]+>)\u200B(<\/span>)/gi, "$1$2"), html;
    };
    /**
     * @return {undefined}
     */
    $.Editable.prototype.wrapDirectContent = function() {
      var selector = $.merge(["UL", "OL", "TABLE"], this.valid_nodes);
      if (!this.options.paragraphy) {
        /** @type {null} */
        var value = null;
        var arr = this.$element.contents();
        /** @type {number} */
        var i = 0;
        for (; i < arr.length; i++) {
          if (1 != arr[i].nodeType || selector.indexOf(arr[i].tagName) < 0) {
            if (!value) {
              value = $('<div class="fr-wrap">');
              $(arr[i]).before(value);
            }
            value.append(arr[i]);
          } else {
            /** @type {null} */
            value = null;
          }
        }
      }
    };
    /**
     * @param {boolean} recurring
     * @param {boolean} deepDataAndEvents
     * @param {boolean} mayParseLabeledStatementInstead
     * @return {?}
     */
    $.Editable.prototype.cleanify = function(recurring, deepDataAndEvents, mayParseLabeledStatementInstead) {
      if (this.browser.msie && $.Editable.getIEversion() < 9) {
        return false;
      }
      var codeSegments;
      if (this.isHTML) {
        return false;
      }
      if (void 0 === recurring) {
        /** @type {boolean} */
        recurring = true;
      }
      if (void 0 === mayParseLabeledStatementInstead) {
        /** @type {boolean} */
        mayParseLabeledStatementInstead = true;
      }
      /** @type {boolean} */
      this.no_verify = true;
      this.$element.find("span").removeAttr("data-fr-verified");
      if (mayParseLabeledStatementInstead) {
        this.saveSelectionByMarkers();
      }
      if (recurring) {
        codeSegments = this.getSelectionElements();
      } else {
        this.wrapDirectContent();
        codeSegments = this.$element.find(this.valid_nodes.join(","));
        if (0 === codeSegments.length) {
          /** @type {Array} */
          codeSegments = [this.$element.get(0)];
        }
      }
      var skip;
      var val;
      if (codeSegments[0] != this.$element.get(0)) {
        /** @type {number} */
        var i = 0;
        for (; i < codeSegments.length; i++) {
          var me = $(codeSegments[i]);
          if (0 === me.find(this.valid_nodes.join(",")).length) {
            skip = me.html();
            val = this.cleanOutput(me.get(0), deepDataAndEvents);
            if (val !== skip) {
              me.html(val);
            }
          }
        }
      } else {
        if (0 === this.$element.find(this.valid_nodes.join(",")).length) {
          skip = this.$element.html();
          val = this.cleanOutput(this.$element.get(0), deepDataAndEvents);
          if (val !== skip) {
            this.$element.html(val);
          }
        }
      }
      this.$element.find("[data-fr-idx]").removeAttr("data-fr-idx");
      this.$element.find(".fr-wrap").each(function() {
        $(this).replaceWith($(this).html());
      });
      this.$element.find(".f-marker").html("");
      if (mayParseLabeledStatementInstead) {
        this.restoreSelectionByMarkers();
      }
      this.$element.find("span").attr("data-fr-verified", true);
      /** @type {boolean} */
      this.no_verify = false;
    };
  }(jQuery); 