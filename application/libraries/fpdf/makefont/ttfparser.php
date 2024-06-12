of Object.entries(sample.breakdownTree)){const relatedName=`${histogram.name}:${category}`;let relatedHist=histograms.getHistogramsNamed(relatedName)[0];if(!relatedHist){relatedHist=histograms.createHistogram(relatedName,histogram.unit,[],{binBoundaries:LOADING_METRIC_BOUNDARIES,summaryOptions:{count:false,max:false,min:false,sum:false,},});let relatedNames=histogram.diagnostics.get('breakdown');if(!relatedNames){relatedNames=new tr.v.d.RelatedNameMap();histogram.diagnostics.set('breakdown',relatedNames);}
relatedNames.set(category,relatedName);}
relatedHist.addSample(breakdown.total,{breakdown:tr.v.d.Breakdown.fromEntries(Object.entries(breakdown.events)),});}}}
function loadingMetric(histograms,model){const firstPaintHistogram=histograms.createHistogram('timeToFirstPaint',timeDurationInMs_smallerIsBetter,[],{binBoundaries:LOADING_METRIC_BOUNDARIES,description:'time to first paint',summaryOptions:SUMMARY_OPTIONS,alertGrouping:[tr.v.d.ALERT_GROUPS.LOADING_PAINT],});const firstContentfulPaintHistogram=histograms.createHistogram('timeToFirstContentfulPaint',timeDurationInMs_smallerIsBetter,[],{binBoundaries:LOADING_METRIC_BOUNDARIES,description:'time to first contentful paint',summaryOptions:SUMMARY_OPTIONS,alertGrouping:[tr.v.d.ALERT_GROUPS.LOADING_PAINT],});const firstContentfulPaintCpuTimeHistogram=histograms.createHistogram('cpuTimeToFirstContentfulPaint',timeDurationInMs_smallerIsBetter,[],{binBoundaries:LOADING_METRIC_BOUNDARIES,description:'CPU time to first contentful paint',summaryOptions:SUMMARY_OPTIONS,alertGrouping:[tr.v.d.ALERT_GROUPS.LOADING_PAINT],});const onLoadHistogram=histograms.createHistogram('timeToOnload',timeDurationInMs_smallerIsBetter,[],{binBoundaries:LOADING_METRIC_BOUNDARIES,description:'time to onload. '+'This is temporary metric used for PCv1/v2 sanity checking',summaryOptions:SUMMARY_OPTIONS,});const firstMeaningfulPaintHistogram=histograms.createHistogram('timeToFirstMeaningfulPaint',timeDurationInMs_smallerIsBetter,[],{binBoundaries:LOADING_METRIC_BOUNDARIES,description:'time to first meaningful paint',summaryOptions:SUMMARY_OPTIONS,alertGrouping:[tr.v.d.ALERT_GROUPS.LOADING_PAINT],});const firstMeaningfulPaintCpuTimeHistogram=histograms.createHistogram('cpuTimeToFirstMeaningfulPaint',timeDurationInMs_smallerIsBetter,[],{binBoundaries:LOADING_METRIC_BOUNDARIES,description:'CPU time to first meaningful paint',summaryOptions:SUMMARY_OPTIONS,alertGrouping:[tr.v.d.ALERT_GROUPS.LOADING_PAINT],});const timeToInteractiveHistogram=histograms.createHistogram('timeToInteractive',timeDurationInMs_smallerIsBetter,[],{binBoundaries:TIME_TO_INTERACTIVE_BOUNDARIES,description:'Time to Interactive',summaryOptions:SUMMARY_OPTIONS,alertGrouping:[tr.v.d.ALERT_GROUPS.LOADING_PAINT],alertGrouping:[tr.v.d.ALERT_GROUPS.LOADING_INTERACTIVITY],});const totalBlockingTimeHistogram=histograms.createHistogram('totalBlockingTime',timeDurationInMs_smallerIsBetter,[],{binBoundaries:TIME_TO_INTERACTIVE_BOUNDARIES,description:'Total Blocking Time',summaryOptions:SUMMARY_OPTIONS,alertGrouping:[tr.v.d.ALERT_GROUPS.LOADING_INTERACTIVITY],});const timeToFirstCpuIdleHistogram=histograms.createHistogram('timeToFirstCpuIdle',timeDurationInMs_smallerIsBetter,[],{binBoundaries:TIME_TO_INTERACTIVE_BOUNDARIES,description:'Time to First CPU Idle',summaryOptions:SUMMARY_OPTIONS,alertGrouping:[tr.v.d.ALERT_GROUPS.LOADING_INTERACTIVITY],});const aboveTheFoldLoadedToVisibleHistogram=histograms.createHistogram('aboveTheFoldLoadedToVisible',timeDurationInMs_smallerIsBetter,[],{binBoundaries:TIME_TO_INTERACTIVE_BOUNDARIES,description:'Time from first visible to load for AMP pages only.',summaryOptions:SUMMARY_OPTIONS,});const firstViewportReadyHistogram=histograms.createHistogram('timeToFirstViewportReady',timeDurationInMs_smallerIsBetter,[],{binBoundaries:TIME_TO_INTERACTIVE_BOUNDARIES,description:'Time from navigation to load for AMP pages only. ',summaryOptions:SUMMARY_OPTIONS,});const largestImagePaintHistogram=histograms.createHistogram('largestImagePaint',timeDurationInMs_smallerIsBetter,[],{binBoundaries:LOADING_METRIC_BOUNDARIES,description:'Time to Largest Image Paint',summaryOptions:SUMMARY_OPTIONS,});const largestTextPaintHistogram=histograms.createHistogram('largestTextPaint',timeDurationInMs_smallerIsBetter,[],{binBoundaries:LOADING_METRIC_BOUNDARIES,description:'Time to Largest Text Paint',summaryOptions:SUMMARY_OPTIONS,});const largestContentfulPaintHistogram=histograms.createHistogram('largestContentfulPaint',timeDurationInMs_smallerIsBetter,[],{binBoundaries:LOADING_METRIC_BOUNDARIES,description:'Time to Largest Contentful Paint',summaryOptions:SUMMARY_OPTIONS,alertGrouping:[tr.v.d.ALERT_GROUPS.LOADING_PAINT],});const layoutShiftHistogram=histograms.createHistogram('mainFrameCumulativeLayoutShift',unitlessNumber_smallerIsBetter,[],{binBoundaries:LAYOUT_SHIFT_SCORE_BOUNDARIES,description:'Main Frame Document Cumulative Layout Shift Score',summaryOptions:SUMMARY_OPTIONS,alertGrouping:[tr.v.d.ALERT_GROUPS.LOADING_LAYOUT],});const navigationStartHistogram=histograms.createHistogram('navigationStart',timeDurationInMs_smallerIsBetter,[],{binBoundaries:LOADING_METRIC_BOUNDARIES,description:'navigationStart',summaryOptions:SUMMARY_OPTIONS,});tr.metrics.sh.rectsBasedSpeedIndexMetric(histograms,model);const chromeHelper=model.getOrCreateHelper(tr.model.helpers.ChromeModelHelper);for(const pid in chromeHelper.rendererHelpers){const rendererHelper=chromeHelper.rendererHelpers[pid];if(rendererHelper.isChromeTracingUI)continue;const samplesSet=collectLoadingMetricsForRenderer(rendererHelper);const lcpSamples=findLargestContentfulPaintHistogramSamples(chromeHelper.browserHelper.mainThread.sliceGroup.slices);addSamplesToHistogram(lcpSamples,largestContentfulPaintHistogram,histograms);addSamplesToHistogram(samplesSet.firstPaintSamples,firstPaintHistogram,histograms);addSamplesToHistogram(samplesSet.firstContentfulPaintSamples,firstContentfulPaintHistogram,histograms);addSamplesToHistogram(samplesSet.firstContentfulPaintCpuTimeSamples,firstContentfulPaintCpuTimeHistogram,histograms);addSamplesToHistogram(samplesSet.onLoadSamples,onLoadHistogram,histograms);addSamplesToHistogram(samplesSet.aboveTheFoldLoadedToVisibleSamples,aboveTheFoldLoadedToVisibleHistogram,histograms);addSamplesToHistogram(samplesSet.firstViewportReadySamples,firstViewportReadyHistogram,histograms);addSamplesToHistogram(samplesSet.largestImagePaintSamples,largestImagePaintHistogram,histograms);addSamplesToHistogram(samplesSet.largestTextPaintSamples,largestTextPaintHistogram,histograms);addSamplesToHistogram(samplesSet.layoutShiftSamples,layoutShiftHistogram,histograms);addSamplesToHistogram(samplesSet.navigationStartSamples,navigationStartHistogram,histograms);}
const samplesSet=collectMetricsFromLoadExpectations(model,chromeHelper);addSamplesToHistogram(samplesSet.firstMeaningfulPaintSamples,firstMeaningfulPaintHistogram,histograms);addSamplesToHistogram(samplesSet.firstMeaningfulPaintCpuTimeSamples,firstMeaningfulPaintCpuTimeHistogram,histograms);addSamplesToHistogram(samplesSet.interactiveSamples,timeToInteractiveHistogram,histograms);addSamplesToHistogram(samplesSet.firstCpuIdleSamples,timeToFirstCpuIdleHistogram,histograms);addSamplesToHistogram(samplesSet.totalBlockingTimeSamples,totalBlockingTimeHistogram,histograms);}
tr.metrics.MetricRegistry.register(loadingMetric);return{loadingMetric,createBreakdownDiagnostic};});'use strict';tr.exportTo('tr.metrics',function(){const SPA_NAVIGATION_START_TO_FIRST_PAINT_DURATION_BIN_BOUNDARY=tr.v.HistogramBinBoundaries.createExponential(1,1000,50);function spaNavigationMetric(histograms,model){const histogram=new tr.v.Histogram('spaNavigationStartToFpDuration',tr.b.Unit.byName.timeDurationInMs_smallerIsBetter,SPA_NAVIGATION_START_TO_FIRST_PAINT_DURATION_BIN_BOUNDARY);histogram.description='Latency between the input event causing'+' a SPA navigation and the first paint event after it';histogram.customizeSummaryOptions({count:false,sum:false,});const modelHelper=model.getOrCreateHelper(tr.model.helpers.ChromeModelHelper);if(!modelHelper){return;}
const rendererHelpers=modelHelper.rendererHelpers;if(!rendererHelpers){return;}
const browserHelper=modelHelper.browserHelper;for(const rendererHelper of Object.values(rendererHelpers)){const spaNavigations=tr.metrics.findSpaNavigationsOnRenderer(rendererHelper,browserHelper);for(const spaNav of spaNavigations){let beginTs=0;if(spaNav.navStartCandidates.inputLatencyAsyncSlice){const beginData=spaNav.navStartCandidates.inputLatencyAsyncSlice.args.data;beginTs=model.convertTimestampToModelTime('traceEventClock',beginData.INPUT_EVENT_LATENCY_BEGIN_RWH_COMPONENT.time);}else{beginTs=spaNav.navStartCandidates.goToIndexSlice.start;}
const rangeOfInterest=tr.b.math.Range.fromExplicitRange(beginTs,spaNav.firstPaintEvent.start);const networkEvents=tr.e.chrome.EventFinderUtils.getNetworkEventsInRange(rendererHelper.process,rangeOfInterest);const breakdownDict=tr.metrics.sh.generateWallClockTimeBreakdownTree(rendererHelper.mainThread,networkEvents,rangeOfInterest);const breakdownDiagnostic=new tr.v.d.Breakdown();breakdownDiagnostic.colorScheme=tr.v.d.COLOR_SCHEME_CHROME_USER_FRIENDLY_CATEGORY_DRIVER;for(const label in breakdownDict){breakdownDiagnostic.set(label,parseInt(breakdownDict[label].total*1e3)/1e3);}
histogram.addSample(rangeOfInterest.duration,{'Breakdown of [navStart, firstPaint]':breakdownDiagnostic,'Start':new tr.v.d.RelatedEventSet(spaNav.navigationStart),'End':new tr.v.d.RelatedEventSet(spaNav.firstPaintEvent),'Navigation infos':new tr.v.d.GenericSet([{url:spaNav.url,pid:rendererHelper.pid,navStart:beginTs,firstPaint:spaNav.firstPaintEvent.start}]),});}}
histograms.addHistogram(histogram);}
tr.metrics.MetricRegistry.register(spaNavigationMetric);return{spaNavigationMetric,};});'use strict';tr.exportTo('tr.metrics.sh',function(){const LATENCY_BOUNDS=tr.v.HistogramBinBoundaries.createLinear(0,20,100);function clockSyncLatencyMetric(values,model){const domains=Array.from(model.clockSyncManager.domainsSeen).sort();for(let i=0;i<domains.length;i++){for(let j=i+1;j<domains.length;j++){const latency=model.clockSyncManager.getTimeTransformerError(domains[i],domains[j]);const hist=new tr.v.Histogram('clock_sync_latency_'+
domains[i].toLowerCase()+'_to_'+domains[j].toLowerCase(),tr.b.Unit.byName.timeDurationInMs_smallerIsBetter,LATENCY_BOUNDS);hist.customizeSummaryOptions({avg:true,count:false,max:false,min:false,std:false,sum:false,});hist.description='Clock sync latency for domain '+domains[i]+' to domain '+domains[j];hist.addSample(latency);values.addHistogram(hist);}}}
tr.metrics.MetricRegistry.register(clockSyncLatencyMetric);return{clockSyncLatencyMetric,};});'use strict';tr.exportTo('tr.metrics.sh',function(){const CPU_TIME_PERCENTAGE_BOUNDARIES=tr.v.HistogramBinBoundaries.createExponential(0.01,50,200);function cpuTimeMetric(histograms,model,opt_options){let rangeOfInterest=model.bounds;if(opt_options&&opt_options.rangeOfInterest){rangeOfInterest=opt_options.rangeOfInterest;}else{const chromeHelper=model.getOrCreateHelper(tr.model.helpers.ChromeModelHelper);if(chromeHelper){const chromeBounds=chromeHelper.chromeBounds;if(chromeBounds){rangeOfInterest=chromeBounds;}}}
let allProcessCpuTime=0;for(const pid in model.processes){const process=model.processes[pid];if(tr.model.helpers.ChromeRendererHelper.isTracingProcess(process)){continue;}
let processCpuTime=0;for(const tid in process.threads){const thread=process.threads[tid];processCpuTime+=thread.getCpuTimeForRange(rangeOfInterest);}
allProcessCpuTime+=processCpuTime;}
let normalizedAllProcessCpuTime=0;if(rangeOfInterest.duration>0){normalizedAllProcessCpuTime=allProcessCpuTime/rangeOfInterest.duration;}
const unit=tr.b.Unit.byName.normalizedPercentage_smallerIsBetter;const cpuTimeHist=new tr.v.Histogram('cpu_time_percentage',unit,CPU_TIME_PERCENTAGE_BOUNDARIES);cpuTimeHist.description='Percent CPU utilization, normalized against a single core. Can be '+'greater than 100% if machine has multiple cores.';cpuTimeHist.setAlertGrouping([tr.v.d.ALERT_GROUPS.CPU_USAGE]);cpuTimeHist.customizeSummaryOptions({avg:true,count:false,max:false,min:false,std:false,sum:false});cpuTimeHist.addSample(normalizedAllProcessCpuTime);histograms.addHistogram(cpuTimeHist);}
tr.metrics.MetricRID, offset
		$data .= pack('nnn', 4, 6+strlen($cmap), 0); // format, length, language
		$data .= $cmap;
		$this->SetTable('cmap', $data);
	}

	function BuildHhea()
	{
		$this->LoadTable('hhea');
		$numberOfHMetrics = count($this->subsettedGlyphs);
		$data = substr_replace($this->tables['hhea']['data'], pack('n',$numberOfHMetrics), 4+15*2, 2);
		$this->SetTable('hhea', $data);
	}

	function BuildHmtx()
	{
		$data = '';
		foreach($this->subsettedGlyphs as $id)
		{
			$glyph = $this->glyphs[$id];
			$data .= pack('nn', $glyph['w'], $glyph['lsb']);
		}
		$this->SetTable('hmtx', $data);
	}

	function BuildLoca()
	{
		$data = '';
		$offset = 0;
		foreach($this->subsettedGlyphs as $id)
		{
			if($this->indexToLocFormat==0)
				$data .= pack('n', $offset/2);
			else
				$data .= pack('N', $offset);
			$offset += $this->glyphs[$id]['length'];
		}
		if($this->indexToLocFormat==0)
			$data .= pack('n', $offset/2);
		else
			$data .= pack('N', $offset);
		$this->SetTable('loca', $data);
	}

	function BuildGlyf()
	{
		$tableOffset = $this->tables['glyf']['offset'];
		$data = '';
		foreach($this->subsettedGlyphs as $id)
		{
			$glyph = $this->glyphs[$id];
			fseek($this->f, $tableOffset+$glyph['offset'], SEEK_SET);
			$glyph_data = $this->Read($glyph['length']);
			if(isset($glyph['components']))
			{
				// Composite glyph
				foreach($glyph['components'] as $offset=>$cid)
				{
					$ssid = $this->glyphs[$cid]['ssid'];
					$glyph_data = substr_replace($glyph_data, pack('n',$ssid), $offset, 2);
				}
			}
			$data .= $glyph_data;
		}
		$this->SetTable('glyf', $data);
	}

	function BuildMaxp()
	{
		$this->LoadTable('maxp');
		$numGlyphs = count($this->subsettedGlyphs);
		$data = substr_replace($this->tables['maxp']['data'], pack('n',$numGlyphs), 4, 2);
		$this->SetTable('maxp', $data);
	}

	function BuildPost()
	{
		$this->Seek('post');
		if($this->glyphNames)
		{
			// Version 2.0
			$numberOfGlyphs = count($this->subsettedGlyphs);
			$numNames = 0;
			$names = '';
			$data = $this->Read(2*4+2*2+5*4);
			$data .= pack('n', $numberOfGlyphs);
			foreach($this->subsettedGlyphs as $id)
			{
				$name = $this->glyphs[$id]['name'];
				if(is_string($name))
				{
					$data .= pack('n', 258+$numNames);
					$names .= chr(strlen($name)).$name;
					$numNames++;
				}
				else
					$data .= pack('n', $name);
			}
			$data .= $names;
		}
		else
		{
			// Version 3.0
			$this->Skip(4);
			$data = "\x00\x03\x00\x00";
			$data .= $this->Read(4+2*2+5*4);
		}
		$this->SetTable('post', $data);
	}

	function BuildFont()
	{
		$tags = array();
		foreach(array('cmap', 'cvt ', 'fpgm', 'glyf', 'head', 'hhea', 'hmtx', 'loca', 'maxp', 'name', 'post', 'prep') as $tag)
		{
			if(isset($this->tables[$tag]))
				$tags[] = $tag;
		}
		$numTables = count($tags);
		$offset = 12 + 16*$numTables;
		foreach($tags as $tag)
		{
			if(!isset($this->tables[$tag]['data']))
				$this->LoadTable($tag);
			$this->tables[$tag]['offset'] = $offset;
			$offset += strlen($this->tables[$tag]['data']);
		}

		// Build offset table
		$entrySelector = 0;
		$n = $numTables;
		while($n!=1)
		{
			$n = $n>>1;
			$entrySelector++;
		}
		$searchRange = 16*(1<<$entrySelector);
		$rangeShift = 16*$numTables - $searchRange;
		$offsetTable = pack('nnnnnn', 1, 0, $numTables, $searchRange, $entrySelector, $rangeShift);
		foreach($tags as $tag)
		{
			$table = $this->tables[$tag];
			$offsetTable .= $tag.$table['checkSum'].pack('NN', $table['offset'], $table['length']);
		}

		// Compute checkSumAdjustment (0xB1B0AFBA - font checkSum)
		$s = $this->CheckSum($offsetTable);
		foreach($tags as $tag)
			$s .= $this->tables[$tag]['checkSum'];
		$a = unpack('n2', $this->CheckSum($s));
		$high = 0xB1B0 + ($a[1]^0xFFFF);
		$low = 0xAFBA + ($a[2]^0xFFFF) + 1;
		$checkSumAdjustment = pack('nn', $high+($low>>16), $low);
		$this->tables['head']['data'] = substr_replace($this->tables['head']['data'], $checkSumAdjustment, 8, 4);

		$font = $offsetTable;
		foreach($tags as $tag)
			$font .= $this->tables[$tag]['data'];

		return $font;
	}

	function LoadTable($tag)
	{
		$this->Seek($tag);
		$length = $this->tables[$tag]['length'];
		$n = $length % 4;
		if($n>0)
			$length += 4 - $n;
		$this->tables[$tag]['data'] = $this->Read($length);
	}

	function SetTable($tag, $data)
	{
		$length = strlen($data);
		$n = $length % 4;
		if($n>0)
			$data = str_pad($data, $length+4-$n, "\x00");
		$this->tables[$tag]['data'] = $data;
		$this->tables[$tag]['length'] = $length;
		$this->tables[$tag]['checkSum'] = $this->CheckSum($data);
	}

	function Seek($tag)
	{
		if(!isset($this->tables[$tag]))
			$this->Error('Table not found: '.$tag);
		fseek($this->f, $this->tables[$tag]['offset'], SEEK_SET);
	}

	function Skip($n)
	{
		fseek($this->f, $n, SEEK_CUR);
	}

	function Read($n)
	{
		return $n>0 ? fread($this->f, $n) : '';
	}

	function ReadUShort()
	{
		$a = unpack('nn', fread($this->f,2));
		return $a['n'];
	}

	function ReadShort()
	{
		$a = unpack('nn', fread($this->f,2));
		$v = $a['n'];
		if($v>=0x8000)
			$v -= 65536;
		return $v;
	}

	function ReadULong()
	{
		$a = unpack('NN', fread($this->f,4));
		return $a['N'];
	}

	function CheckSum($s)
	{
		$n = strlen($s);
		$high = 0;
		$low = 0;
		for($i=0;$i<$n;$i+=4)
		{
			$high += (ord($s[$i])<<8) + ord($s[$i+1]);
			$low += (ord($s[$i+2])<<8) + ord($s[$i+3]);
		}
		return pack('nn', $high+($low>>16), $low);
	}

	function Error($msg)
	{
		throw new Exception($msg);
	}
}
?>
