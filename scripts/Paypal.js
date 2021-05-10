class Paypal {

       constructor(el) {
        this._el = el;       // l'élément bouton paypal 
        this._elControleur = document.querySelector('[data-js-controleur]');
        this._elControleurAction = document.querySelector('[data-js-controleur-action]');
        this._nomControleur = this._elControleur.dataset.jsControleur,
        this._contoleurAction  = this._elControleurAction.dataset.jsControleurAction;
        this._amount = "";
        this._items = "";
        this.init();
    
    }

    //  Initialisation de la class Paypal pour lui donner vie !
    init = () => {

       this.gestionBoutonPaypal();
       
    }

    gestionBoutonPaypal = () => {

          // This function displays Smart Payment Buttons on your web page.
          paypal.Buttons({

            env: 'sandbox', // Or 'production',
    
            commit: true, // Show a 'Pay Now' button
    
            funding: {
                 disallowed: [ paypal.FUNDING.CREDIT ],
                 disallowed: [ paypal.FUNDING.CARD ],
                 disallowed: [ paypal.FUNDING.VENMO ],
                 disallowed: [ paypal.FUNDING.PAYLATER ]
              },
  
              style: {
                color: 'gold',
                size: 'small'
              },
  
              intent:"SALE",
  
 /*              // onClick is called when the button is clicked
              onClick: function()  {
  
                console.log("class Paypal - function gestionBoutonPaypal - paypal.Buttons - onClick - IN")
                this.preparerOrder();
  
              }, */
  
  
              createOrder: function(data, actions) {
                this._elTotal = document.querySelector('[data-js-total]');
                this._elTotalPartiel = document.querySelector('[data-js-total-patiel]'); 
                let montant =  parseFloat(this._elTotalPartiel.innerHTML).toFixed(2);
   /*              montant = '1.75'; */
                console.log("class Paypal - function createOrder - IN - montant :");
                console.log(montant);
                console.log(`'${montant}'`);               
                  // This function sets up the details of the transaction, including the amount and line item details.
                  return actions.order.create({
                    purchase_units: [{           
                        /* description: this.product.description, */
                      
                        amount: {
                         /*  currency_code: 'CAD', */
                          value: `${montant}`
                        /*   value: '1.50' */
                        }
                    }]
                  });
              },
  
              onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                  console.log(details);
                  // This function shows a transaction success message to your buyer.
                  alert('Transaction completed by ' + details.payer.name.given_name);
                  window.location.href = `index.php?${this._nomControleur}&action=${this._contoleurAction}`;
                });
              }
  
/*                onCancel: function (data) {
                // Show a cancel page, or return to cart
                alert('Transaction cancel by ' + details.payer.name.given_name);
                window.location.href = `index.php?${this._nomControleur}&action=${this._contoleurAction}`;
              }, */
  
/*               onError: function (err) {
                // For example, redirect to a specific error page
                alert('Transaction error for ' + details.payer.name.given_name);
                window.location.href = `index.php?${this._nomControleur}&action=${this._contoleurAction}`;
              }  */
  
            }).render('#paypal-button-container');
      
    }

 
    preparerOrder = () => {
      console.log("class Paypal - function preparerOrder - IN");
    
      let unObjItem = "";
      let unObjAmount = new this.Amount();
      let tabPanier = JSON.parse(localStorage.getItem('panierAchat'));

      for (let i = 0, l = tabPanier.length; i < l; i++) {

          // S'il y a une voiture dans cet index  du panier, on crée un Items 
          if (tabPanier[i] != null) {
              nbrVoitureTraite++;

              unObjItem = new this.Item(tabPanier[i]); // On crée l'objet litéral Item;
              console.log("class Paypal - function preparerOrder - AFTER ->  new this.Item 0  unObjItem : ");
              console.log(unObjItem);
              
              unObjAmount.details.subtotal += parseInt(unObjItem.price) * parseInt(unObjItem.quantite);
              this._items.push(unObjItem);
          }
      }
 
      
    
    }


    Item(commandeVoiture) {
      this.currency     = "CAD";
      this.name         =  commandeVoiture.marque + " " + commandeVoiture.model + " " + commandeVoiture.annee;
      this.price        = commandeVoiture.prix;
     // this.tax =  $commandeVoiture.year;
      this.quantity     = commandeVoiture.quantite;
      this.sku          = commandeVoiture.id;
    }
    
    Amount() {
      this.currency     = "CAD";
      this.total         = 0;
      this.details.subtotal = 0;
      this.details.shipping = 0;
      this.details.tax = 0;
      
    }
}