<p class="text-center text-bold">@if($ewcCode->hazardous) @lang("exports.ewc.header_title.dangerous") @else @lang("exports.ewc.header_title.non_dangerous") @endif</p>
@if(!empty($ewcCode->name))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.name")</span>: {{ $ewcCode->name }}</p>@endif
@if(!empty($ewcCode->code))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.code")</span>: {{ $ewcCode->code }}@if($ewcCode->hazardous)*@endif</p>@endif
@if(!empty($ewcCode->short_name))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.short_name")</span>: {{ $ewcCode->short_name }}</p>@endif
@if(!empty($ewcCode->physical_form))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.physical_form")</span>: {{ $ewcCode->physical_form }}</p>@endif
@if(!empty($ewcCode->packaging_method))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.packaging_method")</span>: {{ $ewcCode->packaging_method }}</p>@endif
@if(!empty($ewcCode->h_property))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.h_property")</span>: {{ $ewcCode->h_property }}</p>@endif
@if(!empty($ewcCode->chemical_name_of_parts))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.chemical_name_of_parts")</span>: {{ $ewcCode->chemical_name_of_parts }}</p>@endif
@if(!empty($ewcCode->expected_delivery_frequency))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.expected_delivery_frequency")</span>: {{ $ewcCode->expected_delivery_frequency }}</p>@endif
@if(!empty($ewcCode->type_of_hazard))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.type_of_hazard")</span>: {{ $ewcCode->type_of_hazard }}</p>@endif
@if(!empty($ewcCode->r_sentences))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.r_sentences")</span>: {{ $ewcCode->r_sentences }}</p>@endif
@if(!empty($ewcCode->hazardous_reactions))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.hazardous_reactions")</span>: {{ $ewcCode->hazardous_reactions }}</p>@endif
@if(!empty($ewcCode->origin))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.origin")</span>: {{ $ewcCode->origin }}</p>@endif
@if(!empty($ewcCode->technology_identifier_number))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.technology_identifier_number")</span>: {{ $ewcCode->technology_identifier_number }}</p>@endif
@if(!empty($ewcCode->teaor_codes))<p class="mb-0"><span class="text-bold">@lang("ewc-codes.teaor_codes")</span>: {{ $ewcCode->teaor_codes }}</p>@endif
