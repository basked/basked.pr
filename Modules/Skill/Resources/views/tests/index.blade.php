@extends('skill::layouts.master')
@section('content')
    <div id="app">
        <block-code prop-lang="kotlin" prop-code='/*
 Create a POJO with getters, setters, `equals()`, `hashCode()`, `toString()` and `copy()` in a single line:
*/

data class Customer(val name: String, val email: String, val company: String)

// Or filter a list using a lambda expression:

val positiveNumbers = list.filter { it > 0 }
println("Value=$positiveNumbers")

// Want a singleton? Create an object:

object ThisIsASingleton {
    val companyName: String = "JetBrains"
}'></block-code>



        <block-code prop-lang="kotlin" prop-code='/*
 Use any existing library on the JVM, as there’s 100% compatibility, including SAM support.
*/

import io.reactivex.Flowable
import io.reactivex.schedulers.Schedulers

Flowable.fromCallable {
        Thread.sleep(1000) //  imitate expensive computation
        "Done"
    }
    .subscribeOn(Schedulers.io())
    .observeOn(Schedulers.single())
    .subscribe(::println, Throwable::printStackTrace)'></block-code>
    </div>
@endsection


