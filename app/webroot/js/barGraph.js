function BarGraph(ctx) {
	//private
	var that = this;
	var draw = function (arr) {
		var numOfBars = arr.length;
		var barWidth;
		var barHeight;
		var maxBarHeight;
		var gradient;
		var graphAreaWidth = that.width;
		var graphAreaHeight = that.height;
		
		if (ctx.canvas.width !== that.width || ctx.canvas.height !== that.height) {
			ctx.canvas.width = that.width;
			ctx.canvas.height = that.height;
		}
		
		ctx.fillStyle = that.bgColor;
		ctx.fillRect(0, 0, that.width, that.height);
		
		if (that.xAxisLabelArr.length) {
			graphAreaHeight -= 40;
		} else {
			return;
		}
		
		barWidth = graphAreaWidth / numOfBars - that.margin * 2;
		maxBarHeight = graphAreaHeight - 25;
		
		var maxValue = 0;
		for (var i = 0; i < numOfBars; i++) {
			if (arr[i] > maxValue) {
				maxValue = arr[i];
			}
		}
		
		var ratio;
		for (var i = 0; i < numOfBars; i++) {
			ratio = (maxValue == 0) ? 0 : arr[i] / maxValue;
			barHeight = maxBarHeight * ratio;
			
			ctx.shadowOffsetX = 2;
			ctx.shadowOffsetY = 2;
			ctx.shadowBlur = 2;
			ctx.shadowColor = "#999";
			
			ctx.fillStyle = "#333";
			ctx.fillRect(that.width / numOfBars * i + that.margin, graphAreaHeight - barHeight, barWidth, barHeight);
			
			ctx.shadowOffsetX = 0;
			ctx.shadowOffsetY = 0;
			ctx.shadowBlur = 0;
			
			ctx.fillStyle = "#333";
			ctx.font = "bold 12px sans-serif";
			ctx.textAligh = "center";
			try {
				ctx.fillText(parseInt(arr[i],10), i * that.width / numOfBars + (that.width / numOfBars) / 2, graphAreaHeight - barHeight - 10);
			} catch (ex) {}
			
			if (that.xAxisLabelArr[i] && numOfBars < 10) {
				ctx.fillStyle = "#333";
				ctx.font = "bold 12px sans-serif";
				ctx.textAlign = "center";
				try {
					ctx.fillText(that.xAxisLabelArr[i], i * that.width / numOfBars + (that.width / numOfBars) / 2, that.height - 10);
			    } catch (ex) {}
			}
		}
	};
	//public
	this.width = 450;
	this.height = 150;
	this.margin = 5;
	this.xAxisLabelArr = [];
	this.yAxisLabelArr = [];
	this.bgColor = "#fff";
	
	this.update = function(arr) {
		draw(arr);
	};
}