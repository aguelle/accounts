import * as utils from './functions';


document.getElementById('formAdd').addEventListener('submit', function (event) {
    event.preventDefault();
    // Check and validate data
    const data = {
        action: 'add',
        token: utils.getToken(),
        name: this.querySelector('input[name="name"]').value,
        amount : this.querySelector('input[name="amount"]').value,
        date_transaction : this.querySelector('input[name="date"]').value
    };

    if (data.name.length < 1) {
        utils.displayError(' texte trop court.');
        return;
    }
    if (data.token.length < 1) {
        utils.displayError('Erreur, veuillez recommencer.');
        return;
    }

    utils.fetchApi('POST', data)
        .then(responseApi => {
            // An error occurs, dispay error message
            if (!responseApi.result) {
                utils.displayError(responseApi.error);
                return;
            }
            utils.displayError("Transaction enregistrée.");
        });
});