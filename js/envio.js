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

export function setPanel(objForm,panelParams){    
    return new Promise(function(resolve, reject) {        
        const form_params = serialize(objForm)
        const params = `${panelParams}&${form_params}`
        //Ajax request
        const req = new XMLHttpRequest();
        req.open('POST', objForm.action);
        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        // Handle the events
        req.onload = function() {
            if (req.status >= 200 && req.status < 400) {
                resolve(req.responseText);
            }else{
                reject();    
            }
        };
        req.onerror = function() {
            reject();
        };        
        req.send(params);
    });
};

export function getPanel(parametros){
    return new Promise(function(resolve, reject) {        
        const url = './api.php'
        //Ajax request
        const req = new XMLHttpRequest();
        req.open('POST', url);
        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        // Handle the events
        req.onload = function() {
            if (req.status >= 200 && req.status < 400) {
                resolve(req.responseText);
            }else{
                reject();    
            }
        };
        req.onerror = function() {
            reject();
        };        
        req.send(parametros);
    });
}

export function sendFile(formData){
    return new Promise(function(resolve, reject){
    const url = './api.php'
    //Ajax request
    const req = new XMLHttpRequest();
    req.open('POST', url);
    //req.setRequestHeader('Content-type','multipart/form-data');
    // Handle the events
    req.onload = function() {
        if (req.status >= 200 && req.status < 400) {
            resolve(req.responseText);
        }else{
            reject();    
        }
    };
    req.onerror = function() {
        reject();
    };        
    req.send(formData);
});
}