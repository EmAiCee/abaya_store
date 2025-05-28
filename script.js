	let prod_card = document.querySelectorAll(".product-card");
	let numb_item = 0;
	let prodArray = [];
	prod_card.forEach((k,index) => {
		k.addEventListener("mouseover", () => {
			showDets(k);
		})

		k.addEventListener("mouseleave", () => {
			hidDets(k);
		})
		let cartBtn = k.querySelectorAll("span:nth-child(2) span:nth-child(4) button[type='button']");
		cartBtn[0].onclick = function() {
			cartNum(+1,k)
		}
		cartBtn[1].onclick = function() {
			cartNum(-1,k)
		}
		k.querySelector("span:nth-child(2) span:nth-child(4) button[type='submit']").onclick = function () {
			let id = k.querySelector("span:nth-child(2) span:nth-child(4) input:nth-child(1)").value;
			let quanty = k.querySelector("span:nth-child(2) span:nth-child(4) input:nth-child(3)").value;
			addItem(id,quanty,k)
		}
	})

	function showDets(elem){
			elem.querySelector("span:nth-child(2) span:nth-child(1)").style.transform = "translateY(0%)";
			elem.querySelector("span:nth-child(2) span:nth-child(1)").style.transition = "all .5s ease";

			elem.querySelector("span:nth-child(2) span:nth-child(2)").style.transform = "translateY(0%)";
			elem.querySelector("span:nth-child(2) span:nth-child(2)").style.transition = "all .5s ease";

			elem.querySelector("span:nth-child(2) span:nth-child(3)").style.transform = "translateY(0%)";
			elem.querySelector("span:nth-child(2) span:nth-child(3)").style.transition = "all .5s ease";

			elem.querySelector("span:nth-child(2) span:nth-child(4)").style.transform = "translateY(0%)";
			elem.querySelector("span:nth-child(2) span:nth-child(4)").style.opacity = "100%";
			elem.querySelector("span:nth-child(2) span:nth-child(4)").style.transition = "all .5s ease";
	}

	function hidDets(elem){
			elem.querySelector("span:nth-child(2) span:nth-child(1)").style.transform = "translateY(220%)";
			elem.querySelector("span:nth-child(2) span:nth-child(1)").style.transition = "all .5s ease";

			elem.querySelector("span:nth-child(2) span:nth-child(2)").style.transform = "translateY(280%)";
			elem.querySelector("span:nth-child(2) span:nth-child(2)").style.transition = "all .5s ease";

			elem.querySelector("span:nth-child(2) span:nth-child(3)").style.transform = "translateY(130%)";
			elem.querySelector("span:nth-child(2) span:nth-child(3)").style.transition = "all .5s ease";

			elem.querySelector("span:nth-child(2) span:nth-child(4)").style.transform = "translateY(100%)";
			elem.querySelector("span:nth-child(2) span:nth-child(4)").style.opacity = "0%";
			elem.querySelector("span:nth-child(2) span:nth-child(4)").style.transition = "all .5s ease";
	}

	function cartNum(opr,elem){
		let cartInput = elem.querySelector("span:nth-child(2) span:nth-child(4) input:nth-child(3)");
		
		let newCartNum = parseInt(cartInput.value) + (opr);
		if (newCartNum < 1){
			cartInput.value = 1
		}
		else{
			cartInput.value = newCartNum;
		}
	}

	function addItem(ItemID,ItemQuant,elem){
		elem.querySelector("span:nth-child(2) span:nth-child(4) button[type='submit']").style.backgroundColor = "#34b292";
		elem.querySelector("span:nth-child(2) span:nth-child(4) button[type='submit']").style.color = "white";
		elem.querySelector("span:nth-child(2) span:nth-child(4) button[type='submit']").style.transition = "all .5s ease";
		elem.querySelector("span:nth-child(2) span:nth-child(4) button[type='submit']").innerHTML = "Added";
		elem.querySelector("span:nth-child(2) span:nth-child(4) input:nth-child(3)").value = "1";
		document.querySelector("header span button:nth-child(1)").style.backgroundColor = "#539383";
		document.querySelector("header span button:nth-child(1)").style.color = "white";
		document.querySelector("header span button:nth-child(1)").style.transition = "all .4s ease";
		var counter = 0;
		var resetCart = setInterval(() => {
			if (counter > 0) {
				clearInterval(resetCart);
			}
			else{
				counter++;
				elem.querySelector("span:nth-child(2) span:nth-child(4) button[type='submit']").style.backgroundColor = "#e4a41b";
				elem.querySelector("span:nth-child(2) span:nth-child(4) button[type='submit']").style.color = "black";
				elem.querySelector("span:nth-child(2) span:nth-child(4) button[type='submit']").innerHTML = "Add To Cart";
			}
		},700)
		numb_item++;
		if (numb_item < 2) {
			document.querySelector("header span button:nth-child(1) i").remove();
			let span = document.createElement("span");
			span.innerHTML = numb_item;
			span.style.backgroundColor = "#bedad3";
			span.style.width = "15%";
			span.style.height = "55%";
			span.style.borderRadius = "50%";
			span.style.color = "#1c312b";
			span.style.marginLeft = "10px";
			document.querySelector("header span button:nth-child(1)").appendChild(span);
		}
		else{
			document.querySelector("header span button:nth-child(1) span").innerHTML = numb_item;
		}
		prodArray.push(ItemID+" "+ItemQuant)
		document.getElementById("prod_array").value = prodArray;
	}