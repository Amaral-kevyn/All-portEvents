SELECT typeOfEvents.type,activityOfEvents.activity FROM `appartenir`
JOIN `activityOfEvents` ON appartenir.activityOfEvents_id = activityOfEvents.activityOfEvents_id
JOIN `typeOfEvents` ON appartenir.typeOfEvents_id = typeOfEvents.typeOfEvents_id
WHERE appartenir.typeOfEvents = :appartenir.typeOfEvents;