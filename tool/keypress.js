<!--
ns4 = (document.layers)? true:false
ie4 = (document.all)? true:false
function cf() {
				for (i = 0; i < document.forms[0].elements.length; i++) {
					if ((ns4) && (document.forms[0].elements[i].type != "hidden")
					|| (ie4) && (document.forms[0].elements[i].type != "hidden" )) {
						document.forms[0].elements[i].focus()
						break
					}
				}
}
function keyDown(e) {
	if (ns4) {PKey=e.which; el = e.target.type ; sk = e.modifiers}
	if (ie4) {PKey=event.keyCode; el = event.srcElement.tagName; sk = event.shiftKey}
	if (PKey == "13") {
		if (el.toLowerCase() != "textarea") {
			keyDowntest(e)
			return false;
		} else {
			if ((ns4) && (sk == '4') || (ie4) && (sk)) {
				keyDowntest(e)
				return false;
			}
		}
	}
}
function keyDowntest(e) {
	for (var i = 0; i < document.forms[0].elements.length; i++) {
		if ((ie4) && (document.forms[0].elements[i] == event.srcElement)
		||  (ns4) && (document.forms[0].elements[i] == e.target)) {
			if ((i + 1) == document.forms[0].elements.length)
				document.forms[0].elements[0].focus()
			else
				for (; i < document.forms[0].elements.length; i++) {
					if ((ns4) && (document.forms[0].elements[i+1].type != "hidden")
					|| (ie4) && (document.forms[0].elements[i+1].type != "hidden" )) {
						document.forms[0].elements[i+1].focus()
						break
					}
					if ((ns4) && (document.forms[0].elements[i+1].type != "hidden")
					|| (ie4) && (document.forms[0].elements[i+1].type != "hidden" )) {
						document.forms[0].elements[i+1].focus()
						break
					}
				}
			break
		}
	}
//			if (i == document.forms[0].elements.length)
//				document.forms[0].elements[0].focus()
}
document.onkeydown = keyDown
if (ns4) document.captureEvents(Event.KEYDOWN)
//-->
