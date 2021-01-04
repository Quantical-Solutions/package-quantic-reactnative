import React, { Component } from 'react';
import {StatusBar, View, StyleSheet, Text} from 'react-native';
import Logo from "../../../../../app/ReactNative/assets/not-connected.svg";

export default class App extends Component {

    render() {
        return (
            <View style={styles.view}>
                <Logo style={styles.logo} />
                <Text style={styles.text}>Ready to play ?</Text>
                <Text style={styles.small}>
                    Welcome to your Laravel - ReactNative Package</Text>
            </View>
        );
    }
}

const styles = StyleSheet.create({
    view: {
        flex: 1,
        backgroundColor: '#F7F7F7',
        justifyContent: 'center',
        alignItems: 'center'
    },
    text: {
        color: 'black',
        fontWeight: 'bold',
        fontSize: 30,
    },
    small: {
        color: 'gray',
        fontSize: 14,
    },
    logo: {
        width: 80,
        height: 80
    }
});