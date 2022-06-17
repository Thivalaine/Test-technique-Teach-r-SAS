import * as React from 'react';
import {
  Text,
  View,
  SafeAreaView,
  Image, Animated,
    Dimensions,
    Platform,
    ScrollView,
    StyleSheet, Button, Pressable } from 'react-native';
import Carousel from 'react-native-snap-carousel';
import carouselItems from './components/item'

const HEADER_EXPANDED_HEIGHT = 400;
const HEADER_COLLAPSED_HEIGHT = 100;

const { width: SCREEN_WIDTH } = Dimensions.get("screen")

export default class App extends React.Component {

  constructor(props){
    super(props);
    this.state = {
        contacts: [],
        isLoaded: false,
      activeIndex:0, scrollY: new Animated.Value(0),
    }
  }

  _renderItem({item,index}){
    return (
        <View style={{
          backgroundColor:'white',
          borderRadius: 5,
          shadowColor: "#000",
          shadowOffset: {
              width: 0,
              height: 2,
          },
          shadowOpacity: 0.25,
          shadowRadius: 4.84,
          elevation: 5,
          height: 500,
          padding: 50,
          marginLeft: 25,
          marginRight: 25, }}>
            <Image style={{
                width: 50,
                height: 50,
                float: 'left',
                borderRadius: 50,
            }} source={item.image}
            />
          <Text style={{fontSize: 15, marginBottom: 15}}>{item.name}</Text>
            <Text style={{color: 'grey', fontSize: 10}}>{item.preformation}</Text>
          <Text style={{marginBottom: 15}}>{item.formation}</Text>
            <Text style={{color: 'grey', fontSize: 10}}>{item.predescription}</Text>
          <Text style={{marginBottom: 15}}>{item.description}</Text>
            <Button color="#0071CC"
                title="Prendre cours avec ce Teach'r"
                onPress={() => Alert.alert('Simple Button pressed')}
            />
            <Pressable style={styles.button} onPress={() => Alert.alert('Simple Button pressed')}>
                <Text style={styles.text}>Retirer ce Teach'r de mes favoris</Text>
            </Pressable>
        </View>

    )
  }

  render() {
      const headerHeight = this.state.scrollY.interpolate({
          inputRange: [0, HEADER_EXPANDED_HEIGHT-HEADER_COLLAPSED_HEIGHT],
          outputRange: [HEADER_EXPANDED_HEIGHT, HEADER_COLLAPSED_HEIGHT],
          extrapolate: 'clamp'
      });
      const headerTitleOpacity = this.state.scrollY.interpolate({
          inputRange: [0, HEADER_EXPANDED_HEIGHT-HEADER_COLLAPSED_HEIGHT],
          outputRange: [0, 1],
          extrapolate: 'clamp'
      });
      const heroTitleOpacity = this.state.scrollY.interpolate({
          inputRange: [0, HEADER_EXPANDED_HEIGHT-HEADER_COLLAPSED_HEIGHT],
          outputRange: [1, 0],
          extrapolate: 'clamp'
      });

      const headerTitle = "Teach'r favoris"

    return (
        // Affichage du collapse header
        <SafeAreaView style={{flex: 1, backgroundColor:'white'}}>
            <View style={styles.container}>
                <Animated.View style={[styles.header, { height: headerHeight }]}>
                    <Animated.Text style={{textAlign: 'center', fontSize: 18, color: 'white', marginTop: 28, opacity: headerTitleOpacity}}>{headerTitle}</Animated.Text>
                    <Animated.Text style={{textAlign: 'center', fontSize: 32, color: 'white', position: 'absolute', bottom: 16, left: 16, opacity: heroTitleOpacity}}>{headerTitle}</Animated.Text>
                </Animated.View>
                <ScrollView
                    contentContainerStyle={styles.scrollContainer}
                    onScroll={Animated.event(
                        [{ nativeEvent: {
                                contentOffset: {
                                    y: this.state.scrollY
                                }
                            }
                        }])
                    }
                    scrollEventThrottle={16}>
                    <SafeAreaView style={{ paddingTop: 30 }}>
                        <View style={{ flex: 1, flexDirection:'row', justifyContent: 'center', }}>
                            <Carousel
                                layout={"default"}
                                ref={ref => this.carousel = ref}
                                data={carouselItems}
                                sliderWidth={300}
                                itemWidth={300}
                                renderItem={this._renderItem}
                                onSnapToItem = { index => this.setState({activeIndex:index}) } />
                        </View>
                    </SafeAreaView>
                </ScrollView>
            </View>
        </SafeAreaView>
    );
  }

}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: 'white',
    },
    scrollContainer: {
        padding: 16,
        paddingTop: HEADER_EXPANDED_HEIGHT
    },
    header: {
        backgroundColor: '#0071CC',
        position: 'absolute',
        width: SCREEN_WIDTH,
        top: 0,
        left: 0,
        zIndex: 9999
    },
    button: {
        marginTop: 15,
        alignItems: 'center',
        justifyContent: 'center',
        borderWidth: 2,
        borderColor: "orange",
        elevation: 3,
        backgroundColor: 'white'
    },
    text: {
        fontSize: 16,
        fontWeight: 'bold',
        color: 'orange',
    },
});
