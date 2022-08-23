import React, { Component } from 'react';

class ReserveCustomer extends Component {
    constructor(props) {
        super(props);
        this.state = {
           name: '',
           IsLogin: false,
        }

        this.props = props;
        this.handleChangeName = this.handleChangeName.bind(this);
        this.nextStep = this.nextStep.bind(this);
        this.handleChange = this.handleChange.bind(this);
    }
     
    handleChangeName(e) {
        var value = e.target.value;
        this.setState({
            name: value,
        });
    }
    nextStep() {
        var step = 2;
        var email = this.state.email;
        var name = this.state.name;
        var phone = this.state.phone;
        this.props.clickButton(step, email, name, phone);
        
    }
    componentDidMount() {
        var user = sessionStorage.getItem("UserLogin")
            var userObject = JSON.parse(user)
            console.log(userObject !== undefined);
            
            if (userObject !== undefined && userObject !== null) {
            this.setState({
                email: userObject.user_email,
                name: userObject.user_name,
                IsLogin: true
            })
        }

      }
      handleChange(e) {
        if (e.target.id === 'name') {
            this.setState({ name: e.target.value });
        } else if (e.target.id === 'email') {
            this.setState({ email: e.target.value });
        } 
        else if (e.target.id === 'phone') {
            this.setState({ phone: e.target.value });
        } 
    }
    render() {
        
        return ( 
            <div className="customer_info">
                <h3>Please input your information: </h3>
                <form id="information" action="#" method="post">
                <fieldset>
                <input name="name" type="text" class="form-control" id="name" placeholder="Name" required="" value = { this.state.name } onChange = { this.handleChange }/>
                </fieldset>
                <fieldset>
                <input name="email" type="text" class="form-control" id="email" placeholder="Email" required="" value = { this.state.email } onChange = { this.handleChange }/>
                </fieldset>
                <fieldset>
                <input name="phone" type="text" class="form-control" id="phone" placeholder="Phone number" required="" value = { this.state.phone } onChange = { this.handleChange }/>
                </fieldset>
                <fieldset>
                    <button type="button" id="form-submit" class="btn" onClick = { this.nextStep }>Next step</button>
                </fieldset>
            </form>
            </div>
                
        );
    }
}
export default ReserveCustomer;