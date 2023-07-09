// test suite name
describe('Detail page test', function () {
// Test case
    beforeEach(() => {
        cy.visit('http://localhost/Main-product-with-properties/SWDEMO10007.2')
    })
    it('Clicks the purchase button', function (){
        cy.get('.btn-buy').click()
    });
});