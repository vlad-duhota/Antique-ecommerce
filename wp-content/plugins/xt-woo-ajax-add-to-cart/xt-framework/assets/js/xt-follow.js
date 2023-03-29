;( function( window ) {

    'use strict';

    var XT_FOLLOW = {};

    XT_FOLLOW.accounts = {
        'site': {'name': 'XplodedThemes', 'url': 'http://xplodedthemes.com'},
        'twitter': {'name': 'Twitter', 'url': 'https://twitter.com/XplodedThemes'},
        'facebook': {'name': 'Facebook', 'url': 'https://facebook.com/xplodedthemes/'},
        'linkedin': {'name': 'LinkedIn', 'url': 'https://www.linkedin.com/company/xplodedthemes/'},
        'envato': {'name': 'Envato', 'url': 'https://themeforest.net/user/xplodedthemes'}
    };

    XT_FOLLOW.init = function(accounts, exclude, selector) {

        accounts = typeof(accounts) !== 'undefined' ? XT_FOLLOW.mergeAccounts(accounts) : XT_FOLLOW.accounts;
        accounts = typeof(exclude) !== 'undefined' ? XT_FOLLOW.excludeAccounts(accounts, exclude) : accounts;
        selector = typeof(selector) !== 'undefined' ? selector : null;

        var widget = document.createElement('div');
        widget.className = 'xt-follow';
        widget.innerHTML = XT_FOLLOW.getNetworkLinks(accounts);

        if(selector) {

            var selectorEl = document.body.querySelector(selector);
            if(selectorEl) {
                selectorEl.parentNode.replaceChild(widget, selectorEl);
            }

        }else {

            document.write(widget.outerHTML);
        }
    };

    XT_FOLLOW.getNetworkLinks = function(accounts) {

        var output = '';

        for (var key in accounts) {
            // skip loop if the property is from prototype
            if (!accounts.hasOwnProperty(key)) {
                continue;
            }

            output += '<a href="'+accounts[key].url+'" target="_blank" title="Follow us on '+accounts[key].name+'" class="xt-follow-'+key+'"></a>';
        }

        return output;
    };


    XT_FOLLOW.mergeAccounts = function(obj2) {

        var obj1 = this.accounts;

        Object.assign(this.accounts, obj2);

        return obj1;
    };

    XT_FOLLOW.excludeAccounts = function(accounts, exclude) {

        for(var i = 0 ; i < exclude.length ; i++) {
            delete accounts[exclude[i]];
        }

        return accounts;
    };

    window.XT_FOLLOW = XT_FOLLOW;

} )( window );