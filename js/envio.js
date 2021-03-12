/*genera el objeto segun el formulario que se pase por parametro*/
 function serialize(objForm){    
    // Get all fields
    const fields = [].slice.call(objForm.elements, 0);
    return fields.map(function(ele) {
            const name = ele.name;
            const type = ele.type;
            if (!name || ele.disabled || type === 'file' || (/(checkbox|radio)/.test(type) && !ele.checked)){
                return '';
            }            
            if (type === 'select-multiple') {
                return ele.options.map(function(opt) {
                        return opt.selected ? `${encodeURIComponent(name)}=${encodeURIComponent(opt.value)}` : '';
                    })
                    .filter(function(item) {
                        return item;
                    })
                    .join('&');
            }
            return `${encodeURIComponent(name)}=${encodeURIComponent(ele.value)}`;
        })
        .filter(function(item) {
            return item;
        })
        .join('&');    
}

export function setPanel(objForm,panel,accion){
    return new Promise(function(resolve, reject) {
        const form_params = serialize(objForm)
        const params = `tipo=${panel}&accion=${accion}&${form_params}`
        //Ajax request
        const req = new XMLHttpRequest();
        req.open('POST', objForm.action, true);
        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        // Handle the events
        req.onload = function() {
            if (req.status >= 200 && req.status < 400) {
                resolve(req.responseText);
            }
        };
        req.onerror = function() {
            reject();
        };        
        req.send(params);
    });
};