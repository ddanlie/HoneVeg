// const { createApp } = Vue;

let headApp =  {
    data () {
        return {
            // buttonFocusState : {
            //     "home" : false,
            //     "categories" : false,
            //     "events" : false,
            //     "register" : false,
            //     "sign in" : false
            // }
        }
    },

    methods : {
        // focusButton(whatButton) {
        //     for(let key in this.buttonFocusState) {
        //         this.buttonFocusState[key] = false;
        //     }
        //     this.buttonFocusState[whatButton] = true;
        // }
    }
  };

Vue.createApp(headApp).mount("#headView");